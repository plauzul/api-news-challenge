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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->email,
        'password' => app('hash')->make('123456'),
    ];
});

$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'img' => url("imgs/news.png"),
        'title' => $faker->title,
        'description' => $faker->paragraph,
        'text' => $faker->paragraph
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'img' => url("imgs/events.jpg"),
        'title' => $faker->title,
        'address' => $faker->address,
    ];
});
