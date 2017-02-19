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
     * The group members.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
