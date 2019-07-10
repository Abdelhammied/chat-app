<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Messages::class, function (Faker $faker) {
    return [
        'message' => $faker->words(6, true),
        'sent_by' => $faker->numberBetween(1, 15),
        'chat_room_id' => $faker->numberBetween(1, 15)
    ];
});
