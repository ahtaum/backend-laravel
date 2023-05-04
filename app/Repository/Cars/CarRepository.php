<?php

namespace App\Repository\Cars;

use App\Models\Car;
use App\Models\Vehicle;

class CarRepository implements CarRepositoryInterface {
    public function getAllCars() {
        return Car::all();
    }

    public function createCar(array $data) {
        $vehicle = new Vehicle;
        $vehicle->year = $data["year"];
        $vehicle->color = $data["color"];
        $vehicle->price = $data["price"];
        $vehicle->save();

        $cars = new Car();
        $cars->machine = $data["machine"];
        $cars->capacity = $data["capacity"];
        $cars->type = $data["type"];
        $cars->vehicle()->associate($vehicle);
        $cars->save();

        $vehicle->car()->associate($cars);
        $vehicle->save();
    }
}