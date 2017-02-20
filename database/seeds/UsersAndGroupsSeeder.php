<?php

use Illuminate\Database\Seeder;

class UsersAndGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = bcrypt('password');

        DB::table('groups')->insert([
            [
                'name' => 'grownups',
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Jeff',
                'email' => 'jeff@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Joe',
                'email' => 'joe@example.com',
                'password' => $password,
            ],
        ]);

        DB::table('group_user')->insert([
            [
                'user_id'  => 1,
                'group_id' => 1,
            ],
            [
                'user_id'  => 2,
                'group_id' => 2,
            ],
        ]);
    }
}
