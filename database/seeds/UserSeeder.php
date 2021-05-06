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
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('abc123'),
                'address' => 'Ho Tay',
                'birthday' => '1999-05-08',
            ],
        ]);
    }
}
