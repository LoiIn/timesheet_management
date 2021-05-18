<?php

use Illuminate\Database\Seeder;

class TimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timesheets')->insert([
            [
                'user_id' => '1',
                'problems' => 'none',
                'plan' => 'code and code',
                'created_at' => '2021-05-08 08:00:00'
            ],
            [
                'user_id' => '2',
                'problems' => 'none',
                'plan' => 'code and code',
                'created_at' => '2021-05-07 08:00:00'
            ],
            [
                'user_id' => '3',
                'problems' => 'none',
                'plan' => 'code and code',
                'created_at' => '2021-05-06 08:00:00'
            ],
            [
                'user_id' => '4',
                'problems' => 'none',
                'plan' => 'code and code',
                'created_at' => '2021-05-05 08:00:00'
            ],
            [
                'user_id' => '5',
                'problems' => 'none',
                'plan' => 'code and code',
                'created_at' => '2021-05-04 08:00:00'
            ],
        ]);
    }
}
