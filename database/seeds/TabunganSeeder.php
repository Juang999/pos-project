<?php

use Illuminate\Database\Seeder;

class TabunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tabungans')->insert([
            [
            'user_id' => 2,
            'debit' => 2000000,
            'saldo' => 2000000,
            ]
        ]);
    }
}
