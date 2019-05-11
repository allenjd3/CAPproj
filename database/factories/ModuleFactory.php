<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'number' => 1205,
        'main_title' => 'Special Chemistry',
        'tests' => serialize(['Na', 'K', 'Cl'])
    ];
});
