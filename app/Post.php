<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'whois', 'post', 'imgpost'
    ];
}
