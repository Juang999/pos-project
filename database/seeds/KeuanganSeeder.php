<?php

use Illuminate\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keuangans')->insert([
            'user_id' => 1,
            'debit' => 2000000,
            'saldo' => 2000000,
        ]);
    }
}
