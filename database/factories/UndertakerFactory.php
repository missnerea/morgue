<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Undertaker::class, function (Faker $faker) {
    $gender=$faker->randomElements(['male','female'])[0];
    $startDate='-60 years';
    $endDate='-10 years';
    $timezone='Africa/Nairobi';
    return [
        'first_name'=>$faker->firstName($gender),
        'last_name'=>$faker->lastName,
        'gender'=>$gender,
        'id_number'=>rand(1000000,9999999),
        'date_of_birth'=>$faker->date($format = 'Y-m-d','now'),
        'password'=>Hash::make('123'),
        'admin_id'=>function(){
            return App\Undertaker::find(1);
        }
    ];
});
