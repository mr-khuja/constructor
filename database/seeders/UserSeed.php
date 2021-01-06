<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.uz',
            'password' => '$2y$10$xBVBUxZde.SQK1wiSfiyfuA2jQ6prcy0T34Xb5ByrgX.HzfXqRHoG',
            'created_at' => '2020-12-24 07:46:40',
            'updated_at' => '2021-01-06 10:15:46',
            'role' => 2,
            'image' => '/images/blank.png'
        ]);
    }
}
