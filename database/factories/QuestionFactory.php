<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Question::class, function (Faker $faker) {

    $array = [
        //
        'title' => rtrim($faker->sentence(rand(5,10)), '.'),
        'body' => $faker->paragraphs(4, true),
        'views' => rand(5,10),
        'answers' => rand(5,10),
        'votes' => rand(-5, 10),
        'user_id' => rand(1, 3)
    ];
    $array['slug'] = Str::slug($array['title']);
    return $array;
});
