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
$factory->define(App\User::class, function (Faker\Generator $faker)  {
    static $password;

    return [
        'fullname' => $faker->firstName,
        //'last_name' => $faker->lastName,
        //'type' => randomElement(['member', 'admin']),
        'email' => $faker->unique()->safeEmail,
        'identification' => $faker->ean8,
        'telephone' => $faker->ean8,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'title' => $faker->word,
		'content' => $faker->paragraph,
		'updated_by' => $factory->create(App\User::class)->id,
        'created_by' => $factory->create(App\User::class)->id,
    ];
});

$factory->define(App\Provider::class, function (Faker\Generator $faker)  use ($factory) {
    return [
        'name' => $faker->name,
        'rif' => $faker->ean8,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'name' => $faker->word,
        'info' => $faker->country,
        'quantity' => random_int(100, 300),
        'available' => random_int(1, 100),
        'cost' => random_int(1000, 25000),
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'date' => $faker->date(),
        'end_date' => $faker->date(),
        'title' => $faker->word,
        'user_id' => $factory->create(App\User::class)->id,
        'locale' => $faker->country,
        'notes' => $faker->country,
        'updated' => $factory->create(App\User::class)->id,
        'created' => $factory->create(App\User::class)->id,
    ];
});
/*
$factory->define(App\Register::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'provider_id' => $factory->create(App\Provider::class)->id,
        'product_id' => $factory->create(App\Product::class)->id,
        'info' => $faker->country,
        'quantity' => random_int(1, 200),
        'cost' => random_int(30000, 2500000),
    ];
});*/