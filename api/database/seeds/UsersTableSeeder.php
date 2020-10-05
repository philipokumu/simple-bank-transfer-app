<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'john@simple.com',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Peter',
            'email' => 'Peter@simple.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
