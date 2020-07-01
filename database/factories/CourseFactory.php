<?php

/** @var Factory $factory */

use Faker\Generator as Faker;
use App\Model;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'instructor_id' => 1,
        'img' => "1584209495.png",
        'price' => rand(1,9999),
        'about' => $faker->address,
    ];
});
