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
            'supplier' => 'unilever',
            'alamat' => 'kramat djati',
            'nomor_telepon' => "08123456789",
        ]
        ]);
    }
}
