<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Survey;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Survey::class, function (Faker $faker) {
    return [
        'title'=>'CET-01',
        'user_id'=> 1,
        'module_id' => 1,
        'due_date' => Carbon::parse('+1 week')->toDateTimeString(),
        'is_sent' => false
    ];
});
