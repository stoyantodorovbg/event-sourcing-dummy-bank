<?php

namespace Database\Seeders;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    protected Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}
