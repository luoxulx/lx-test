<?php
/**
 * Created by PhpStorm.
 * User: luoxulx
 * Date: 2018/12/4
 * Time: 22:33
 */

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'name' => '默认测试分类一',
        //'name_en' => '默认测试分类一--en',
        'description' => '描述-'.$faker->streetAddress,
        //'description_en' => '描述en-'.$faker->streetAddress,
        'thumbnail' => null
    ];
});
