<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 22:36
 */

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'name' => '测试tag-'.$faker->streetName,
        //'name_en' => 'name_en-'.$faker->streetName,
        'color' => '#6D1515',
        'style' => 'info',
        'description' => '测试desc',
        //'description_en' => '测试desc-en',
    ];
});
