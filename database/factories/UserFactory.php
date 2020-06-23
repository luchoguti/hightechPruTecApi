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
    $IdCreditCard = \App\CreditCard::query ()->selectRaw ('id')->inRandomOrder ()->first ();
    return [
        'id'=> $faker->uuid,
        'names' => $faker->name,
        'last_names'=> $faker->lastName,
        'type_identification'=> $faker->numberBetween (1,3),
        'number_identification'=> $faker->randomNumber (9),
        'id_credit_card'=> $IdCreditCard->id,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $faker->password,
        'remember_token' => Str::random(10),
    ];
});
