<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Groups in which the user is a member.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Tags created by User.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class, 'created_by_user_id');
    }

    /**
     * Bookmarks owned by User.
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Whether or not the user is a member of the admin group.
     */
    public function isAdmin() : bool
    {
        return $this->groups->contains(1);
    }
}
