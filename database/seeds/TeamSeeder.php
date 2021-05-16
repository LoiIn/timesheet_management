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
            ],
            [
                'leader_id' => 2,
                'name' => 'developer',
            ],
            [
                'leader_id' => 3,
                'name' => 'tester',
            ],
            [
                'leader_id' => 4,
                'name' => 'HR',
            ],
        ]);
    }
}
