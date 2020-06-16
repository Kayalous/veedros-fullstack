<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\PendingEnrollment::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::all()->random()->id,
        'course_id' => \App\Course::all()->random()->id,
        'merchant_order_id' => 'veedpay' .  Str::random(5)
    ];
});
