<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * User who created Tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
