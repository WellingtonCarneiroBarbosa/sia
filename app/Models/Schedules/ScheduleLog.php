<?php

namespace App\Models\Schedules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Models\Schedules\Schedule;

class ScheduleLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id', 'user_id', 'action'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'schedule_logs';

    public $timestamps = true;

    public function schedule_log()
    {
        return $this->hasOne(Schedule::class, 'id', 'schedule_id');
    }

    /**
     * its not editable
     */
    protected static function boot()
    {
        parent::boot();
        static::updating(function($model)
        {
            return false;
        });
    }
}
