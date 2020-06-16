<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\View::class, function (Faker $faker) {
    $course = \App\Course::all()->random();
    return [
        'created_at' => \Carbon\Carbon::now()->subDays(rand(1, 30)),
        'user_id' => \App\User::all()->random()->id,
        'course_id' => $course->id,
        'enrolled' => rand(0,1) == 1,
        'session_id' => $course->chapters->random()->sessions->random()->id,
    ];
});
