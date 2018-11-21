<?php

use Faker\Generator as Faker;

$factory->define(App\Deceased::class, function (Faker $faker) {
    $gender=$faker->randomElements(['male','female'])[0];
    $timezone='Africa/Nairobi';
    $creator= App\Admin::find(2);
    return [
        'first_name'=>$faker->firstName($gender),
        'last_name'=>$faker->lastName,
        'gender'=>$gender,
        'cause_of_death'=>'old age',
        'date_in'=>$faker->dateTimeBetween($startDate='-10 years', $endDate='-1 years'),
        'undertaker_id'=>$creator->id
    ];
});
