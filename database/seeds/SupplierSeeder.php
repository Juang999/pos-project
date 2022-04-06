<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'supplier_name' => 'unilever',
                'address' => 'kramat djati',
                'phone_number' => "08123456789",
            ],
            [
                'supplier_name' => 'Samsung',
                'address' => 'China',
                'phone_number' => "081235464821",
            ],
            [
                'supplier_name' => 'apple',
                'address' => 'America',
                'phone_number' => "0812354263356",
            ],
        ]);
    }
}
