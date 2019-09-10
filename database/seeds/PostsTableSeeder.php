<?php

use App\User;
use App\Post;
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
        $users = User::all();

        if ($users->count() === 0) {
            $this->command->error('No users. Posts will not added.');
            return;
        }

        $postsCount = (int)$this->command->ask('How many posts would you like to be created?', 50);

        $posts = factory(Post::class, $postsCount)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
