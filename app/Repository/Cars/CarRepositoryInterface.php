<?php

namespace App\Repository\Cars;

interface CarRepositoryInterface
{
    public function getAllCars();
    public function createCar(array $data);
}
