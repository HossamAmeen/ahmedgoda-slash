<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(App\Models\Configration::class, function (Faker $faker) {
    return [
        'email' => $faker->safeEmail,
        'en_title' => " ",
        'title' =>  " ",
        'description' => " ",
        'en_description' => $faker->text,
        'home_description' => " ",
        'en_home_description' => $faker->text,
        'phone' => "01010079795",
        'phone2' => "01010079795",
        'whatsapp' => "01010079798",
        'address' =>"الكويت - الكويت - شارع " ,
        'facebook' => "https://www.facebook.com/",
        'twitter' => "https://twitter.com/",
        'instagram' => "https://www.instagram.com/", //
        'video' =>"https://www.youtube.com/embed/AnBHcM-tZsM" ,
        'video2' =>"https://www.youtube.com/embed/AnBHcM-tZsM" ,
        'youtube' =>"https://www.youtube.com" ,
        'user_id' =>1 ,
    ];
});


$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'en_title' => $faker->name,
        'description' => "",
        'en_description' => $faker->text ,
        'is_old_work' => rand(1,0),
        'user_id' =>1 ,
    ];
});
$factory->define(App\Models\Service::class, function (Faker $faker) {

    return [
        'name' => "تقويم الاسنان ",
        'description' => "تقويم الاسنان في اسرع وقت",
        'user_id' =>1 ,
    ];
});

