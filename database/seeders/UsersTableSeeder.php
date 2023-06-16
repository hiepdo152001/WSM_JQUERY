<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'position' => 'ad',

        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'tld',
            'email' => 'd1@gmail.com',
            'password' => Hash::make('12345678'),
            'department_id' => '1',
            'position' => 'tld'

        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'd2',
            'email' => 'd2@gmail.com',
            'password' => Hash::make('12345678'),
            'department_id' => '2',
            'position' => 'tld'

        ]);
    }
}
