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
	static $password;

	return [
		'name' => $faker->name,
		'email' => $faker->unique()->safeEmail,
		'password' => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

$factory->define('App\Client', function (Faker\Generator $faker) {
	return [
		'name' 		=> str_random(20),
		'lastname' 	=> str_random(30),
		'email' 	=> str_random(10).'@gmail.com',
		'phone' 	=> '('.mt_rand(10, 80).') '.mt_rand(9000, 9999).'-'.mt_rand(0000, 9999),
		'active' 	=> 1,
	];
});