<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    $gender=$faker->randomElements(['male','female'])[0];
    $timezone='Africa/Nairobi';
    return [
        'first_name'=>$faker->firstName($gender),
        'last_name'=>$faker->lastName,
        'gender'=>$gender,
        'id_number'=>rand(1000000,9999999),
        'date_of_birth'=>$faker->dateTimeBetween($startDate='-50 years', $endDate='-25 years'),
        'password'=>Hash::make('123')
    ];
});
