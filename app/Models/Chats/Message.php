<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['message'];

    protected $table = "messages";

    public $timestamps = true;

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
