<?php

/*
|--------------------------------------------------------------------------
| Post Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'content' => str_random(500),
        'tags' => str_random(50),
        'image'  => str_random(10),
    ];
});
