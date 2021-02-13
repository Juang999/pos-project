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
            'name' => 'Bangkit Juang Raharjo',
            'nomor_telepon' => '081325507780',
            'email' => 'juangraharjo03@gmail.com',
            'role' => 1,
            'password' => Hash::make('Juang666'),
            ],[
            'name' => 'User1',
            'nomor_telepon' => '0812345678',
            'email' => 'User1@gmail.com',
            'role' => 1,
            'password' => Hash::make('12345678'),
            ],[
            'name' => 'Leader',
            'nomor_telepon' => '0898765432',
            'email' => 'Leader@gmail.com',
            'role' => 4,
            'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
