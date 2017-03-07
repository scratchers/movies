<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class MovieScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $this->scopeViewable($builder);

        $builder->select('movies.*')->distinct();
    }

    /**
     * Scope query to only return viewable movies.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function scopeViewable(Builder &$builder)
    {
        if ( !Auth::check() ) {
            return $builder
                ->leftJoin('group_movie', 'movies.id', '=', 'group_movie.movie_id')
                ->whereNull('group_movie.group_id');
        }

        if ( Auth::user()->isAdmin() ) {
            return $builder;
        }

        return $builder
            ->leftJoin('group_movie', 'movies.id', '=', 'group_movie.movie_id')
            ->leftJoin('group_user', 'group_movie.group_id', '=', 'group_user.group_id')
            ->whereNull('group_movie.group_id')
            ->orWhere('group_user.user_id', Auth::user()->id)
        ;
    }
}
