<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
class Car extends Model
{
    protected $collection = 'cars';
    protected $fillable = [
        'machine', 'capacity', 'type'
    ];

    public $timestamps = true;

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
