<?php

/** @var Factory $factory */

use App\Course;
use App\Enroll;
use App\Model;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Enroll::class, function (Faker $faker) {
    return [
        'created_at' => Carbon::now()->subDays(rand(1, 30)),
        'user_id' => User::all()->random()->id,
        'course_id' => Course::all()->random()->id,
    ];
});
