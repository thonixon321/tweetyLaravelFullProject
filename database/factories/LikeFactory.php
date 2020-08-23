<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'tweet_id' => factory(App\Tweet::class),
        'liked' => true //could make this random, or add new factory for adding dislikes
    ];
});
