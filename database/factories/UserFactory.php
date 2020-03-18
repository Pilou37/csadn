<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activite;
use App\User;
use Faker\Generator as FakerEn;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (FakerEn $faker) {
    $fakerFr = Faker\Factory::create('fr_FR');
    $max = Activite::count();
    return [
        'genre' => $faker->numberBetween(1, 2),
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'password' => bcrypt('12345678'), // password
        'naissance_at' => $faker->date('Y-m-d'),
        'naissance_lieu' => $faker->city,
        'adresse' => $faker->streetAddress,
        'cp' => $faker->numberBetween(37000, 37900),
        'ville' => $faker->city,
        'tel' => $fakerFr->serviceNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->dateTime(),
        'origine' => $faker->numberBetween(1, 4),
        'activite_id' => $faker->numberBetween(1, Activite::count()),
        'licence' => $faker->optional()->randomNumber(),
        'validation_at' => $faker->dateTimeThisYear()/*,
        'remember_token' => $faker->asciify('**********')*/
    ];
});
