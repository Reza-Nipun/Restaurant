<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nipun2',
            'email' => 'mnipunsarker156@gmail.com',
            'password' => Hash::make('12345678'),
            'access_level' => 1,
            'status' => 1,
        ]);
    }
}
