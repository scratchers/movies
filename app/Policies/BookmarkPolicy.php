<?php

namespace App\Policies;

use App\User;
use App\Bookmark;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookmarkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the bookmark.
     *
     * @param  \App\User  $user
     * @param  \App\Bookmark  $bookmark
     * @return mixed
     */
    public function view(User $user, Bookmark $bookmark)
    {
        return $user->id === $bookmark->user_id;
    }

    /**
     * Determine whether the user can create bookmarks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the bookmark.
     *
     * @param  \App\User  $user
     * @param  \App\Bookmark  $bookmark
     * @return mixed
     */
    public function update(User $user, Bookmark $bookmark)
    {
        return $user->id === $bookmark->user_id;
    }

    /**
     * Determine whether the user can delete the bookmark.
     *
     * @param  \App\User  $user
     * @param  \App\Bookmark  $bookmark
     * @return mixed
     */
    public function delete(User $user, Bookmark $bookmark)
    {
        return $user->id === $bookmark->user_id;
    }
}
