<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'corporation'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'customers';

    public $timestamps = true;
    protected $softDelete = true;
}
