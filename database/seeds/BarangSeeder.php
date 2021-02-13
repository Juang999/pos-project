<?php

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert([
            [
            'kategori_id' => 2,
            'nama_barang' => 'yakult',
            'kode_barang' => 123123123,
            'harga' => 1500,
            ],[
            'kategori_id' => 2,
            'nama_barang' => 'air putih',
            'kode_barang' => 456456456,
            'harga' => 500,
            ],[
            'kategori_id' => 1,
            'nama_barang' => 'risol',
            'kode_barang' => 789789789,
            'harga' => 2000,
            ],
        ]);
    }
}
