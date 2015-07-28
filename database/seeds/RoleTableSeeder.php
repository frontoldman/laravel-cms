<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('roles')->insert([
            'title' => '超级管理员',
            'slug'  => 'admin'
        ]);

        DB::table('roles')->insert([
            'title' => '操作员',
            'slug'  => 'opera'
        ]);

        DB::table('roles')->insert([
            'title' => '访客',
            'slug'  => 'visitor'
        ]);

    }
}
