<?php

namespace App\Models\Schedules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'place_id', 'start_date', 'start_time',
        'end_date', 'end_time', 'customer_id', 'details',
        'status',
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'schedules';

    public $timestamps = true;
    protected $softDelete = true;
}
