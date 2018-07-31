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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Furbook\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Furbook\Breed::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});

$factory->define(Furbook\Cat::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'date_of_birth' => $faker->date(),
        'price' => $faker->numberBetween(100, 900),
        'user_id' => 1,
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});