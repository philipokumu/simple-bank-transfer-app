<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'user_id' => '1',
            'name' => 'John',
            'balance' => 15000
        ]);

        DB::table('accounts')->insert([
            'user_id' => '2',
            'name' => 'Peter',
            'balance' => 100000
        ]);
    }
}
