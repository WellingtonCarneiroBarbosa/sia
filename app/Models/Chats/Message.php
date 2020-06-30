<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from', 'to', 'message', 'is_read'
    ];

    protected $table = "messages";

    public $timestamps = true;
}
