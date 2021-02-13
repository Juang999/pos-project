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
            'password' => Hash::make('Juang666'),
            ],[
            'name' => 'User1',
            'nomor_telepon' => '081325507780',
            'email' => 'User1@gmail.com',
            'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
