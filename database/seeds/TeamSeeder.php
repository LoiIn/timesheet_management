<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'leader_id' => 1,
                'name' => 'ceo',
                'created_at' => '1999-05-08',
            ],
            [
                'leader_id' => 2,
                'name' => 'developer',
                'created_at' => '1999-05-08',
            ],
            [
                'leader_id' => 3,
                'name' => 'tester',
                'created_at' => '1999-05-08',
            ],
            [
                'leader_id' => 4,
                'name' => 'HR',
                'created_at' => '1999-05-08',
            ],
        ]);
    }
}
