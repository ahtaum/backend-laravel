<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Vehicle extends Model
{
    protected $collection = 'vehicles';
    protected $fillable = [
        'year', 'color', 'price'
    ];

    public $timestamps = true;

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = intval($value);
    }

    public function motor() {
        return $this->hasOne(Motor::class);
    }

    public function car() {
        return $this->hasOne(Car::class);
    }
}
