<?php

use App\Http\Controllers\SupplierController;
use App\Kategori;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TabunganSeeder::class,
            KategoriSeeder::class, 
            SupplierSeeder::class,
            KeuanganSeeder::class,
        ]);
    }
}
