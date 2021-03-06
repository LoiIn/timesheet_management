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
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(TeamUserSeeder::class);
        $this->call(TimesheetSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
