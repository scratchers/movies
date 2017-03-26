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
        'mnt',
        'title',
        'imdb_id',
        'description',
        'released_on',
        'runtime_minutes',
        'country',
        'language',
        'poster',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
        'released_on',
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
     * Personal tags for the movie.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Genres that belong to the movie.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function __get($key)
    {
        if ($key === 'basename') {
            return $this->basename ?? $this->basename = pathinfo($this->filename, PATHINFO_FILENAME);
        }

        if ($key === 'fillable') {
            return $this->fillable;
        }

        if ( $key === 'title' && empty($this->attributes['title']) ) {
            return $this->__get('basename');
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
    public function scopeAllTagged($query, $tags)
    {
        $count = count($tags);

        return $query
            ->leftJoin('movie_tag AS alltags', 'movies.id', '=', 'alltags.movie_id')
            ->whereIn('alltags.tag_id', $tags)
            ->groupBy('movies.id')
            ->havingRaw("COUNT(DISTINCT alltags.tag_id) = $count")
            // thanks Gordon http://stackoverflow.com/a/27209368/4233593
        ;
    }

    /**
     * Scope query to movies with any of the submitted tags.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAnyTagged($query, $tags)
    {
        return $query
            ->leftJoin('movie_tag AS anytags', 'movies.id', '=', 'anytags.movie_id')
            ->whereIn('anytags.tag_id', $tags)
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
     * Scope query to only return tagged movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllGenres($query, $genres)
    {
        $count = count($genres);

        return $query
            ->leftJoin('genre_movie AS allgenres', 'movies.id', '=', 'allgenres.movie_id')
            ->whereIn('allgenres.genre_id', $genres)
            ->groupBy('movies.id')
            ->havingRaw("COUNT(DISTINCT allgenres.genre_id) = $count")
            // thanks Gordon http://stackoverflow.com/a/27209368/4233593
        ;
    }

    /**
     * Scope query to movies with any of the submitted tags.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAnyGenres($query, $genres)
    {
        return $query
            ->leftJoin('genre_movie AS anygenres', 'movies.id', '=', 'anygenres.movie_id')
            ->whereIn('anygenres.genre_id', $genres)
        ;
    }

    /**
     * Scope query to only return tagged movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotGenres($query, $genres)
    {
        return $query
            ->whereNotIn('movies.id', function($query) use ($genres){
                $query
                    ->select('movie_id')
                    ->from('genre_movie')
                    ->whereIn('genre_id', $genres)
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
