<?php

/** @var Factory $factory */

use App\Course;
use App\Model;
use App\PendingEnrollment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(PendingEnrollment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'subtotal' => Course::all()->random()->price,
        'merchant_order_id' => 'veedpay' .  Str::random(8)
    ];
});
