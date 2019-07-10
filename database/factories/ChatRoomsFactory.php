<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\ChatRoom::class, function (Faker $faker) {
    return [
        'room_id' => $faker->creditCardNumber(null, true, '-'),
        'user_1_id' => $faker->numberBetween(1, 15),
        'user_2_id' => $faker->numberBetween(1, 15)
    ];
});
