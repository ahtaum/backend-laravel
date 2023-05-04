<?php

namespace App\Repository\Motor;

use App\Models\Vehicle;
use App\Models\Motor;

class MotorRepository implements MotorRepositoryInterface {
    protected $vehicle;
    protected $motor;

    public function __construct(Vehicle $vehicle, Motor $motor) {
        $this->vehicle = $vehicle;
        $this->motor = $motor;
    }

    public function getAll() {
        return $this->motor->all();
    }

    public function create(array $data) {
        $vehicle = $this->vehicle->create([
            'year' => $data['year'],
            'color' => $data['color'],
            'price' => $data['price'],
        ]);

        $this->motor->create([
            'machine' => $data['machine'],
            'suspension_type' => $data['suspension_type'],
            'transmision_type' => $data['transmision_type'],
            'vehicle_id' => $vehicle->id,
        ]);
    }
}