<?php

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
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

        $posts = Post::all();

        if ($posts->count() === 0) {
            $this->command->error('No posts. Comments will not added.');
            return;
        }

        $commentsCount = (int)$this->command->ask('How many comments would you like to be created?', 100);


        factory(Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $users) {
            $comment->post_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
