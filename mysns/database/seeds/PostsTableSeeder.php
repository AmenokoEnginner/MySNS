<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->delete();

      $user = App\User::first();

      factory(App\Post::class, 5)->create([
        'user_id' => $user->id,
      ]);
    }
}
