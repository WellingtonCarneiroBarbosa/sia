<?php

namespace App\Models\Places;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Models\Places\Place;

class PlaceLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id', 'user_id', 'action'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'place_logs';

    public $timestamps = true;

    public function place_log()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
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
