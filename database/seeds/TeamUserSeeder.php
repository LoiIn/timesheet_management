<?php

use Illuminate\Database\Seeder;

class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_user')->insert([
            ['team_id' => 1, 'user_id' => 1],
            ['team_id' => 1, 'user_id' => 2],
            ['team_id' => 1, 'user_id' => 3],
            ['team_id' => 1, 'user_id' => 4],
            ['team_id' => 2, 'user_id' => 2],
            ['team_id' => 2, 'user_id' => 5],
            ['team_id' => 2, 'user_id' => 6],
            ['team_id' => 2, 'user_id' => 7],
            ['team_id' => 3, 'user_id' => 3],
            ['team_id' => 3, 'user_id' => 8],
            ['team_id' => 3, 'user_id' => 9],
            ['team_id' => 4, 'user_id' => 4],
            ['team_id' => 4, 'user_id' => 10],
        ]);
    }
}
