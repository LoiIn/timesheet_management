<?php

use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 2,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 3,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 4,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 5,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 6,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 7,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 8,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 9,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 10,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
            [
                'user_id' => 11,
                'month' => 5,
                'registrations_times' => 1,
                'registrations_late_times' => 0,
            ],
        ]);
    }
}
