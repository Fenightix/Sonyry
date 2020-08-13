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
        $this->call(UsersSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(CollectionSeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(UsersGroupsSeeder::class);
        $this->call(NotificationsSeeder::class);
        $this->call(InboxesSeeder::class);
    }
}
