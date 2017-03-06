<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\MovieScope;

class Movie extends Model
{
    use SoftDeletes;

    protected $basename;

    protected $fillable = [
        'filename',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Groups in which the movie is a member.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Does this movie belong to any groups?
     */
    public function hasGroups() : bool
    {
        return !$this->groups->isEmpty();
    }

    /**
     * Common and personal tags for the movie.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function __get($key)
    {
        if ($key === 'basename') {
            return $this->basename ?? $this->basename = basename($this->filename);
        }

        return parent::__get($key);
    }

    public function currentUserTags()
    {
        return $this->tags->intersect(Tag::currentUserTags()->get());
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new MovieScope);
    }

    /**
     * Scope query to only return tagged movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTagged($query, $tags)
    {
        $count = count($tags);

        return $query
            ->leftJoin('movie_tag', 'movies.id', '=', 'movie_tag.movie_id')
            ->whereIn('movie_tag.tag_id', $tags)
            ->groupBy('movies.id')
            ->havingRaw("COUNT(DISTINCT movie_tag.tag_id) = $count")
            // thanks Gordon http://stackoverflow.com/a/27209368/4233593
        ;
    }

    /**
     * Scope query to only return tagged movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotTagged($query, $tags)
    {
        return $query
            ->whereNotIn('movies.id', function($query) use ($tags){
                $query
                    ->select('movie_id')
                    ->from('movie_tag')
                    ->whereIn('tag_id', $tags)
                ;
            })
        ;
    }

    /**
     * Returns the builder instance for pipeline using scope vector.
     * NOTE: There should be a cleaner way to do this.
     * See usage in \App\Http\Controllers\MovieController::index()
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeQueryBuilder($query)
    {
        return $query;
    }
}
