<?php

use Illuminate\Database\Seeder;

class JumlahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jumlahs')->insert([
        [
            'barang_id' => '1',
            'supplier_id' => 1,
            'kode_barang_id' => 123123123,
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ],[
            'barang_id' => '2',
            'supplier_id' => 1,
            'kode_barang_id' => 456456456,
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ],[
            'barang_id' => '3',
            'supplier_id' => 1,
            'kode_barang_id' => 789789789,
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ]
        ]);
    }
}
