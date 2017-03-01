<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

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
