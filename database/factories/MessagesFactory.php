<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\Chats\Message::class, function (Faker $faker) {

    do {
        $from = rand(1, 100);
        $to = rand(1, 100);
    }while($from == $to);

    return [
        'from' => $from,
        'to' => $to,
        'text' => $faker->sentence()
    ];
});
