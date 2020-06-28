<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\Schedule\HistoricSchedule;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'corporation', 'cnpj', 'name',
        'phone', 'email'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'customers';

    public $timestamps = true;
    protected $softDelete = true;

    /***
     * Scheduling Customers
     * 
     */
    public function schedulingCustomers()
    {
        return $this->hasMany(Schedule::class);
    }

    public function historicSchedulingCustomers()
    {
        return $this->hasMany(HistoricSchedule::class);
    }
}
