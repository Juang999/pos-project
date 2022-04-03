<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'WebApi'
        ]);

        Role::create([
            'name' => 'WarehouseAdmin',
            'guard_name' => 'WebApi'
        ]);

        Role::create([
            'name' => 'Cashier',
            'guard_name' => 'WebApi'
        ]);
    }
}
