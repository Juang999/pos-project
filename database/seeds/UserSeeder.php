<?php

use App\User;
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
        $SuperAdmin = User::create([
            'name' => 'super-admin',
            'phone_number' => '0812345678910',
            'email' => 'SuperAdmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $SuperAdmin->assignRole('SuperAdmin');

        $WarehouseAdmin = User::create([
            'name' => 'warehouse-admin',
            'phone_number' => '098765432110',
            'email' => 'warehouse@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $WarehouseAdmin->assignRole('WarehouseAdmin');

        $cashier = User::create([
            'name' => 'cashier',
            'phone_number' => '081235456798710',
            'email' => 'cashier@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $cashier->assignRole('Cashier');

        // DB::table('users')->insert([
        //     [
        //     'name' => 'owner',
        //     'nomor_telepon' => '0898765432',
        //     'email' => 'owner@gmail.com',
        //     // 'role' => 5,
        //     'password' => Hash::make('12345678'),
        //     ],[
        //     'name' => 'role1',
        //     'nomor_telepon' => '0812353234333',
        //     'email' => 'role1@gmaiil.com',
        //     // 'role' => 1,
        //     'password' => Hash::make('12345678'),
        //     ],[
        //     'name' => 'role2',
        //     'nomor_telepon' => '08123533325',
        //     'email' => 'role2@gmaiil.com',
        //     // 'role' => 2,
        //     'password' => Hash::make('12345678'),
        //     ],[
        //     'name' => 'role3',
        //     'nomor_telepon' => '0812353244425',
        //     'email' => 'role3@gmaiil.com',
        //     'role' => 3,
        //     'password' => Hash::make('12345678'),
        //     ],[
        //     'name' => 'role4',
        //     'nomor_telepon' => '08123522233',
        //     'email' => 'role4@gmaiil.com',
        //     // 'role' => 4,
        //     'password' => Hash::make('12345678'),
        //     ]
        // ]);
    }
}
