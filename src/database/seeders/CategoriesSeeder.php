<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Admin::first();

        if ($admin) {
            $categories = [
                [
                    'name' => 'Furniture',
                    'description' => 'Various types of office furniture',
                    'created_by' => $admin->id
                ],
                [
                    'name' => 'Elektronics',
                    'description' => 'Electronic devices and accessories',
                    'created_by' => $admin->id
                ],
                [
                    'name' => 'Office Supplies',
                    'description' => 'Supplies required for the office',
                    'created_by' => $admin->id
                ]
            ];

            foreach ($categories as $category) {
                Categories::create($category); 
            }
        }
    }
}
