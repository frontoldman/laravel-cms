<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'username' => 'admin',
            'email' => '529130510@qq.com',
            'password' => bcrypt('123456'),
            'confirmed' => true,
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'kitty',
            'email' => '694790191@qq.com',
            'password' => bcrypt('123456'),
            'confirmed' => true,
            'role_id' => 2,
        ]);

    }
}
