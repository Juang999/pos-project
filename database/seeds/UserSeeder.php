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
            [
            'name' => 'owner',
            'nomor_telepon' => '0898765432',
            'email' => 'owner@gmail.com',
            'role' => 5,
            'password' => Hash::make('12345678'),
            ],[
            'name' => 'role1',
            'nomor_telepon' => '0812353234333',
            'email' => 'role1@gmaiil.com',
            'role' => 1,
            'password' => Hash::make('12345678'),
            ],[
            'name' => 'role2',
            'nomor_telepon' => '08123533325',
            'email' => 'role2@gmaiil.com',
            'role' => 2,
            'password' => Hash::make('12345678'),
            ],[
            'name' => 'role3',
            'nomor_telepon' => '0812353244425',
            'email' => 'role3@gmaiil.com',
            'role' => 3,
            'password' => Hash::make('12345678'),
            ],[
            'name' => 'role4',
            'nomor_telepon' => '08123522233',
            'email' => 'role4@gmaiil.com',
            'role' => 4,
            'password' => Hash::make('12345678'),
            ]
        ]);
    }
}
