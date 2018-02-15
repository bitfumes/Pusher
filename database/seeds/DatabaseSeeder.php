<?php

use Illuminate\Database\Seeder;
use App\Favorite;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create();
        factory(App\Category::class, 5)->create();
        factory(App\Question::class, 20)->create();
        factory(App\Reply::class, 50)->create()->each(function ($reply) {
            $reply->favorite()->save(factory(App\Favorite::class)->make());
        });
        // $this->call(UsersTableSeeder::class);
    }
}
