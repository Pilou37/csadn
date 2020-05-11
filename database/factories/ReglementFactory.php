<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mode;
use App\Reglement;
use Faker\Generator as Faker;

$factory->define(Reglement::class, function (Faker $faker) {
    return [
        'mode_id' => $faker->numberBetween(1, Mode::count()),
        'valeur' => $faker->numerify('1#0'),
        'recu_id' => $faker->optional()->numberBetween(1,50)
        // 'remise_id' => $faker->optional()->numberBetween(1,100)
    ];
});
