<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Articolo;
use Faker\Generator as Faker;

$factory->define(Articolo::class, function (Faker $faker) {
    return [
        'descrizione'=>'articolo descrizione '.uniqid()
    ];
});
