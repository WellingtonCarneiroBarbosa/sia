<?php

namespace App\Models\Schedules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customers\Customer;
use App\Models\Places\Place;
use App\Models\Schedules\ScheduleLog;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class HistoricSchedule extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'place_id', 'participants', 'start',
        'end', 'customer_id', 'details', 'status',
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'historic_schedules';

    public $timestamps = true;
    protected $softDelete = true;

    /***
     * Scheduling Customer
     * 
     */
    public function historicSchedulingCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /***
     * Scheduling Place
     * 
     */
    public function historicSchedulingPlace()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::updating(function($model)
        {
            return false;
        });
    }

}
