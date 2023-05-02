<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    protected $collection = 'users';
    protected $fillable = [
        'name', 'email', 'password'
    ];

    public $timestamps = true;
}
