<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
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
        return $query
            ->leftJoin('movie_tag', 'movies.id', '=', 'movie_tag.movie_id')
            ->whereIn('movie_tag.tag_id', $tags)
        ;
    }

    /**
     * Scope query to only return viewable movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query)
    {
        if ( !Auth::check() ) {
            return $query
                ->leftJoin('group_movie', 'movies.id', '=', 'group_movie.movie_id')
                ->whereNull('group_movie.group_id');
        }

        if ( Auth::user()->isAdmin() ) {
            return $query;
        }

        return $query
            ->leftJoin('group_movie', 'movies.id', '=', 'group_movie.movie_id')
            ->leftJoin('group_user', 'group_movie.group_id', '=', 'group_user.group_id')
            ->whereNull('group_movie.group_id')
            ->orWhere('group_user.user_id', Auth::user()->id)
        ;
    }
}
