<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reglement;
use Faker\Generator as Faker;

$factory->define(Reglement::class, function (Faker $faker) {
    $modeList = ['cheque', 'espece', 'caf', 'cv', 'autre'];
    $cle = rand(0, 4);
    $mode = $modeList[$cle];

    return [
        'mode' => $mode,
        'valeur' => $faker->numerify('1#0'),
        'nr_recu' => $faker->optional()->numberBetween(1,50),
        'nr_remise' => $faker->optional()->numberBetween(1,100),
        'encaissement_at' => $faker->optional()->date()
    ];
});
