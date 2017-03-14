<?php

namespace App\Policies;

use App\User;
use App\Genre;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the genre.
     *
     * @param  \App\User  $user
     * @param  \App\Genre  $genre
     * @return mixed
     */
    public function view(User $user, Genre $genre)
    {
        //
    }

    /**
     * Determine whether the user can create genres.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the genre.
     *
     * @param  \App\User  $user
     * @param  \App\Genre  $genre
     * @return mixed
     */
    public function update(User $user, Genre $genre)
    {
        //
    }

    /**
     * Determine whether the user can delete the genre.
     *
     * @param  \App\User  $user
     * @param  \App\Genre  $genre
     * @return mixed
     */
    public function delete(User $user, Genre $genre)
    {
        //
    }
}
