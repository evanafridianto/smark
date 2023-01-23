<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BusinessProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@smark.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'), // password
        ]);

        \App\Models\Category::factory(8)->create();
        $user = \App\Models\User::factory()->create();
        $busprof = new BusinessProfile();
        $busprof->business_name = 'Roti Mba Ani';
        $busprof->category_id = rand(1, 8);
        $busprof->founded_at = '2010-05-10';
        $busprof->phone = '0834324324';
        $busprof->address = 'Jalan Sigura Gura';
        $busprof->social_media1 = 'www.facebook.com';
        $busprof->social_media2 = 'www.instagram.com';
        $busprof->social_media3 = 'www.linkedin.com';
        $user->businessProfile()->save($busprof);
    }
}