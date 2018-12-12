<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\UserGithub::class, function (Faker $faker) {
    return [
        'login' => 'luoxulx',
        'id' => 35016570,
        'user_id' => 1,
        'node_id' => 'MDQ6VXNlcjM1MDE2NTcw',
        'avatar_url' => 'https://avatars1.githubusercontent.com/u/35016570?v=4',
        'gravatar_id' => '',
        'url' => 'aaa',
        'html_url' => 'https://github.com/luoxulx',
        'followers_url' => 'https://api.github.com/users/luoxulx/followers',
        'following_url' => 'https://api.github.com/users/luoxulx/following{/other_user}',
        'gists_url' => 'https://api.github.com/users/luoxulx/gists{/gist_id}',
        'starred_url' => 'https://api.github.com/users/luoxulx/starred{/owner}{/repo}',
        'subscriptions_url' => 'https://api.github.com/users/luoxulx/subscriptions',
        'organizations_url' => 'https://api.github.com/users/luoxulx/orgs',
        'repos_url' => 'https://api.github.com/users/luoxulx/repos',
        'events_url' => 'https://api.github.com/users/luoxulx/events{/privacy}',
        'received_events_url' => 'https://api.github.com/users/luoxulx/received_events',
        'type' => 'User',
        'site_admin' => false,
        'name' => '14k',
        'company' => null,
        'blog' => 'https://www.lnmpa.top/',
        'location' => 'Shanghai, Asia',
        'email' => 'luoxulx@live.com',
        'hireable' => null,
        'bio' => 'Even if my dreams are lonely, I will not forget to cheer myself up. At least, XX will accompany me to the end!
—LNMPA',
        'public_repos' => 35,
        'public_gists' => 0,
        'followers' => 1,
        'following' => 3,
        'created_at' => '2018-01-02',
        'updated_at' => '2018-12-11'
    ];
});
