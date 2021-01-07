<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Data extends Seeder
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
            'role' => 2,
            'image' => '/images/blank.png',
            'created_at' => '2020-12-24 07:46:40',
            'updated_at' => '2021-01-06 10:15:46',
        ]);
        DB::table('settings')->insert([
            'sitename' => 'sitename',
            'logo' => '/images/logo-text.png',
            'logo_light' => 'http://mirkresel.com/storage/photos/1/logo-light-text.png',
            'favicon' => '/images/logo-icon.png',
            'phone' => '+998 (90) 044-44-00',
            'mobile' => '+998 (90) 044-44-00',
            'email' => 'admin@admin.uz',
            'address' => 'ул. Ниязова-Фаробий, 5 дом, 47 кв.',
            'created_at' => '2020-12-24 07:46:40',
            'updated_at' => '2021-01-06 10:15:46',
        ]);
    }
}
