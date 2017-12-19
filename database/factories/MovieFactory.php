<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Movie::class, function (Faker $faker, \Tmdb\Repository\MovieRepository $movieRepository) {
    $movie = $movieRepository->load($faker->randomNumber()); // Todo verify movie id exists
    return [
        'title' => $faker->title()
        'slug' => $faker->
        'description' => $faker->
        'released_on' => $faker->
        'genre' => $faker->
    ];
});
