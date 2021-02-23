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
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ],[
            'barang_id' => '2',
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ],[
            'barang_id' => '3',
            'input' => 5,
            'output' => 0,
            'total' => 5,
        ]
        ]);
    }
}
