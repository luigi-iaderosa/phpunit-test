<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'email'=> factory(\App\User::class)->create()->email,
        'descrizione'=> 'customer di prova '.uniqid(),
    ];
});
