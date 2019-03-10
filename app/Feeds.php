<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeds extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feeds';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permalink',
        'title',
        'description',
        'visited_by',
        ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'posted_at',
        'created_at',
        'updated_at',
    ];
}
