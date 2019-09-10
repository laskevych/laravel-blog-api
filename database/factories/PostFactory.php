<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'body' => $faker->text(400),
        'created_at' => $faker->dateTimeBetween('-3 months')
    ];
});
