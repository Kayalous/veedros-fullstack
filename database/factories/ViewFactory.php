<?php

/** @var Factory $factory */

use App\Course;
use App\Model;
use App\User;
use App\View;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(View::class, function (Faker $faker) {
    $course = Course::all()->random();
    return [
        'created_at' => Carbon::now()->subDays(rand(1, 30)),
        'user_id' => User::all()->random()->id,
        'course_id' => $course->id,
        'enrolled' => rand(0,1) == 1,
        'session_id' => $course->chapters->random()->sessions->random()->id,
    ];
});
