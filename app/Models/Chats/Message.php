<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from', 'to', 'text'
    ];

    protected $table = "messages";

    public $timestamps = true;
}
