<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'status' =>'Activo',
        'username' =>$faker->userName,
        'password' => bcrypt('123456'), // password
    ];
});


$factory->define(\App\Client::class, function (Faker $faker) {
    return [
        'date_of_admission' => date('Y-m-d'),
        'authorize_data_processing' => 1,
        'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});

$factory->define(\App\ClientPeople::class, function (Faker $faker){
   return [
        'first_name' => $faker->name,
        'last_name' =>$faker->lastName,
        'document_type' =>'Cedula',
        'document_number' => $faker->randomElement(['40224190500', '4012578562','0012345846']),
        'document_expire_date' => $faker->dateTime(),
        'document_expedition_date' => $faker->dateTime(),
        'gender' => $faker->randomElement(['Masculino', 'Femenino']),
        'client_code' => 'C-'.$faker->randomNumber(4,false),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = '2000-01-01')

   ];
});

$factory->define(\App\ClientCompany::class, function (Faker $faker){
    return [
        'business_name' => $faker->company,
        'rnc' =>  $faker->randomNumber(9). $faker->randomNumber(4),
        'rnc_expedition_date' => $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        'rnc_expire_date' => $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        'constitution_date' =>  $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        'client_code' => 'C-'.$faker->randomNumber(4,false),
        'economic_activity_id' => 1
    ];
});

$factory->define(\App\Contact::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
        'nationality' => $faker->country,
        'province_of_birth' => $faker->state,
        'postal_code' => $faker->postcode,
        'address_line1' => $faker->address,
        'address_line2' => '',
        'cell_phone_number' => str_replace(' ','',$faker->phoneNumber),
        'phone_number' => str_replace(' ','',$faker->phoneNumber),
        'email' => $faker->email,
    ];
});
