<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Models\User::class, 1)->create();
        factory(App\Models\Tag::class, 1)->create();
        factory(App\Models\Category::class, 1)->create();
        factory(App\Models\Article::class, 2)->create();
    }
}
