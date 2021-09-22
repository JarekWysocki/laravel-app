<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'fromUser', 'toUser', 'message', 'is_readed'
    ];
}
