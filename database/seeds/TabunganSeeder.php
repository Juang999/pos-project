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
            'user_id' => 1,
            'saldo' => 0,
            ],[
            'user_id' => 2,
            'saldo' => 500,
            ],
        ]);
    }
}
