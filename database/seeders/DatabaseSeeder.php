<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::insert([
            [
                'id' => '1',
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role_id' => '1',
                'password' => bcrypt('password'),
                'created_at' => date('y/m/d H:i:s'),
                'updated_at' => date('y/m/d H:i:s'),
            ],
            [
                'id' => '2',
                'name' => 'Editor',
                'email' => 'editor@editor.com',
                'role_id' => '2',
                'password' => bcrypt('password'),
                'created_at' => date('y/m/d H:i:s'),
                'updated_at' => date('y/m/d H:i:s'),
            ],
        ]);

        Role::insert([
            [
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'name' => 'Editor',
                'slug' => 'editor',
            ]
        ]);

        Setting::insert([
            'sitename' => 'Newsportal Site',
            'siteImage' => 'setting_images/noimage.jpg',
            'siteLogo' => 'setting_logo/noimage.jpg',
            'facebook' => 'http://facebook.com',
            'linkedin' => 'http://linkedin.com',
            'youtube' => 'http://youtube.com',
            'instagram' => 'http://instagram.com',
            'aboutus' => 'This is about us.',
            'address' => 'This is our address.',
        ]);

        Advertisement::insert([
            'homepage_header_image' => 'advertisement_images/noimage.jpg',
            'homepage_header_url' => 'http://example.com',
            'homepage_sidebar_image' => 'advertisement_images/noimage.jpg',
            'homepage_sidebar_url' => 'http://example.com',
            'homepage_bottom_image' => 'advertisement_images/noimage.jpg',
            'homepage_bottom_url' => 'http://example.com',

            'singlepage_header_image' => 'advertisement_images/noimage.jpg',
            'singlepage_header_url' => 'http://example.com',
            'singlepage_sidebar_image' => 'advertisement_images/noimage.jpg',
            'singlepage_sidebar_url' => 'http://example.com',
            'singlepage_bottom_image' => 'advertisement_images/noimage.jpg',
            'singlepage_bottom_url' => 'http://example.com',
        ]);

        $this->call(CategoryTableSeeder::class);
        $this->call(NewsTableSeeder::class);
    }
}
