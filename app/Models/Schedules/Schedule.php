<?php

namespace App\Models\Schedules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customers\Customer;
use App\Models\Places\Place;
use App\Models\Schedules\ScheduleLog;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Schedule extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'place_id', 'participants', 'start', 'end',
        'customer_id', 'details', 'status',
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'schedules';

    public $timestamps = true;
    protected $softDelete = true;

    /***
     * Scheduling Customer
     * 
     */
    public function schedulingCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /***
     * Scheduling Place
     * 
     */
    public function schedulingPlace()
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function schedule_logs()
    {
        return $this->belongsTo(ScheduleLog::class);
    }
}
