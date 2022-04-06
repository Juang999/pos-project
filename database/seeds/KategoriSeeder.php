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
            'category_name' => 'makanan'
        ],[
            'category_name' => 'minuman'
        ],[
            'category_name' => 'pakaian'
        ]
        ]);
    }
}
