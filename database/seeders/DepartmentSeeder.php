<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Division 1',
        ]);

        DB::table('departments')->insert([
            'name' => 'Division 2',
        ]);
    }
}
