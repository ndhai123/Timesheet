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
        DB::table('users')->delete();
        DB::table('users')->insert([
            'name' => 'hai',
            'email' => 'hai@123',
            'role' => 'staff',
            'password' => Hash::make('123456')
        ]);
    }
}
