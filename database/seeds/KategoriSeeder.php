<?php

use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    DB::table('kategoris')->insert([
        [
        'kategori' => 'makanan'
        ],[
        'kategori' => 'minuman'
        ]
        ]);
    }
}
