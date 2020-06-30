<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Schedules\Schedule;

$factory->define(Schedule::class, function (Faker $faker) {
    $start = $faker->dateTimeBetween('2020-06-31 15:00:00','2020-12-30 14:00:00');
    return [
        'title' => $faker->title($maxNbChars = 40),
        'place_id' => rand(1, 8),
        'participants' => 35,
        'start' => $start,
        'end' => $faker->dateTimeBetween($start, '2020-12-30 14:00:00'),
        'customer_id' => rand(1, 50),
        'details' => $faker->paragraph(15),
        'status' => '1'
    ];
});
