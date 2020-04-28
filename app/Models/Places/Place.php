<?php

namespace App\Models\Places;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\Schedule\HistoricSchedule;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Place extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capacity', 'size', 'outletVoltage','hasProjector', 'howManyProjectors',
        'hasTranslationBooth', 'howManyBooths', 'hasSound', 'hasLighting',
        'hasWifi', 'hasAccessibility', 'hasFreeParking'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'places';

    public $timestamps = true;

    /***
     * Scheduling Places
     * 
     */
    public function schedulingPlaces()
    {
        return $this->hasMany(Schedule::class);
    }

    public function historicSchedulingPlaces()
    {
        return $this->hasMany(HistoricSchedule::class);
    }
}
