<?php

use Faker\Generator as Faker;
use App\Favorite;
use App\Question;
use App\User;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::all()->random();
        }
    ];
});
