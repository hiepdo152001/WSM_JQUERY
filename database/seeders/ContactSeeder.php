<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'id' => 1,
            'user_id' => 2,
            'content' => '123',
            'type' => 1,
            'phone' => '1234',
            'project' => 'intern',
            'reason' => 'ly do',
            'time_start' => null,
            'time_end' => null,
            'status' => 1,
        ]);
    }
}
