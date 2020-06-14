<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\User;

class UserLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_action_id', 'action'
    ];

    /***
     * The table's name
     * 
     */
    protected $table = 'user_logs';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user_log()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
