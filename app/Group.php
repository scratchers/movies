<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * The group's users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The group's movies.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
