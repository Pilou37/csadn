<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'password' => bcrypt('12345678'), // password
        'naissance_at' => $faker->date('Y-m-d'),
        'naissance_lieu' => $faker->city,
        'adresse' => $faker->streetAddress,
        'cp' => $faker->numberBetween(37000, 37900),
        'ville' => $faker->city,
        'tel' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => $faker->dateTime(),
        'photo' => $faker->imageUrl($width = 150, $height = 300),
        'origine' => $faker->randomDigit,
        'activite_id' => $faker->numberBetween(1, 3),
        'licence' => $faker->optional()->randomNumber(),
        'licence_at' => $faker->optional()->dateTimeThisYear(),
        'validation_at' => $faker->optional()->dateTimeThisYear()/*,
        'remember_token' => $faker->asciify('**********')*/
    ];
});
