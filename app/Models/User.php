<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $collection = 'users';
    protected $fillable = [
        'email', 'password', 'username'
    ];

    public $timestamps = true;
}
