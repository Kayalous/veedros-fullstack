<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Enroll::class, function (Faker $faker) {
    return [
        'created_at' => \Carbon\Carbon::now()->subDays(rand(1, 30)),
        'user_id' => \App\User::all()->random()->id,
        'course_id' => \App\Course::all()->random()->id,
    ];
});
