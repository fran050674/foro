<?php

use App\Comment;
use App\Post;
use App\User;

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Post::class, function (Faker\Generator $faker, $attributes) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'pending' => true,
        'user_id' => function () {
            // dd('esto se va a ejecutar');
            return factory(User::class)->create()->id;
        },
    ];
});

$factory->define(Comment::class, function (Faker\Generator $faker, $attributes) {
    return [
        'comment' => $faker->paragraph,
        'post_id' => function () {
            return factory(Post::class)->create()->id;
        },
        'user_id' => function () {
            // dd('esto se va a ejecutar');
            return factory(User::class)->create()->id;
        },
    ];
});
