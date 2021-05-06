<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'create_timesheet', 'title' => 'can create timesheet'],
            ['name' => 'update_timesheet',  'title' => 'can update timesheet'],
            ['name' => 'delete_timesheet', 'title' => 'can delete timesheet'],
            ['name' => 'restore_timesheet', 'title' => 'can restore timesheet'],
            ['name' => 'force_delete_timesheet', 'title' => 'can force delete timesheet'],
        ]);
    }
}