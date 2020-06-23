<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CreditCard;
use Faker\Generator as Faker;

$factory->define(CreditCard::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'card_holder_name'=> $faker->name,
        'card_number'=> $faker->creditCardNumber,
        'cvc'=> $faker->randomNumber (3),
        'expiration_card'=> $faker->creditCardExpirationDate
    ];
});
