<?php

namespace App\Models\Places;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schedules\Schedule;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Place extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'places';

    public $timestamps = true;
    protected $softDelete = true;

    /***
     * Scheduling Places
     * 
     */
    public function schedulingPlaces()
    {
        return $this->hasMany(Schedule::class);
    }
}
