<?php

namespace Database\Seeders;

use App\Models\Departments;
use App\Models\position;
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
        UsersTableSeeder::class;
        ContactSeeder::class;
        DepartmentSeeder::class;
    }
}
