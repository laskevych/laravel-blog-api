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
       if ( $this->command->ask('Do you want to refresh database?', 'yes')) {
           $this->command->call('migrate:refresh');
           $this->command->info('Database was refreshed.');
       }

        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            CommentsTableSeeder::class
        ]);
    }
}
