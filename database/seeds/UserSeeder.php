<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
            [
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
            [
                'username' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
            [
                'username' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
            [
                'username' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
            [
                'username' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
        ]);
    }
}
