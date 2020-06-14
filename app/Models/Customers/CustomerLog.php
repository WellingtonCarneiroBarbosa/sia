<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Models\Customers\Customer;

class CustomerLog extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'customer_id', 'user_id', 'action'
   ];

   /***
    * The table's name
    * 
    */
   protected $table = 'customer_logs';

   public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

   public function customer_log()
   {
       return $this->hasOne(Customer::class, 'id', 'customer_id');
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
