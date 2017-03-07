<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by_user_id',
    ];

    /**
     * User who created Tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * The movies that have been tagged by this.
     */
    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }

    /**
     * Scope a query to only include current user's tags.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrentUserTags($query)
    {
        return $query->where('created_by_user_id', '=', Auth::user()->id);
    }
}
