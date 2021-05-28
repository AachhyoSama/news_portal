<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'permission' => 'Manage User',
                'slug' => Str::slug('Manage User'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Permission',
                'slug' => Str::slug('Manage Permission'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Role',
                'slug' => Str::slug('Manage Role'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Category',
                'slug' => Str::slug('Manage Category'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage News',
                'slug' => Str::slug('Manage News'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Multimedia',
                'slug' => Str::slug('Manage Multimedia'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Advertisement',
                'slug' => Str::slug('Manage Advertisement'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Setting',
                'slug' => Str::slug('Manage setting'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'permission' => 'Manage Subscribers',
                'slug' => Str::slug('Manage Subscribers'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
