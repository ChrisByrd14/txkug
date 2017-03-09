<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('Passw0rd'),
        'token' => str_random(64),
        'activated'     => true
    ];
});

$factory->define(App\Models\CommunityLink::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'channel_id' => 1,
        'title' => $faker->sentence,
        'link' => $faker->url,
        'approved' => 0
    ];
});