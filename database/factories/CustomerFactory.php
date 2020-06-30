<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Customers\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    /**
     * CNPJ = 14 DIGITOS
     */
    return array(
        'corporation' => $faker->company(),
        'cnpj' => rand('11111111111111','99999999999999'),
        'name' => $faker->name(),
        'phone' => clearPhoneNumber($faker->phoneNumber()),
        'email' => $faker->companyEmail(),
    );
});
