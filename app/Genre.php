<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    /**
     * The movies that belong to this genre.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
