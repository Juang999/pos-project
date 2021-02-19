<?php

use Illuminate\Database\Seeder;
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
            [
            'name' => 'owner',
            'nomor_telepon' => '0898765432',
            'email' => 'owner@gmail.com',
            'role' => 5,
            'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
