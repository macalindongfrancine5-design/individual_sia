<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Suppliers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $categories = Categories::all();
        $suppliers = Suppliers::all();

        if ($admin && $categories && $suppliers) {
            $items = [
                // Furniture
                [
                    'name' => 'Executive Desk',
                    'description' => 'Spacious wooden executive desk with storage drawers.',
                    'price' => 350.00,
                    'quantity' => 50,
                    'category_id' => $categories->where('name', 'Furniture')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Tech Supplies Co.')->first()->id,
                    'created_by' => $admin->id
                ],
                [
                    'name' => 'Ergonomic Office Chair',
                    'description' => 'Comfortable ergonomic office chair with adjustable features.',
                    'price' => 120.00,
                    'quantity' => 150,
                    'category_id' => $categories->where('name', 'Furniture')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Gadget World')->first()->id,
                    'created_by' => $admin->id
                ],

                // Elektronics
                [
                    'name' => 'Smartphone 5G',
                    'description' => 'Smartphone with 128GB storage and 5G connectivity.',
                    'price' => 600.00,
                    'quantity' => 100,
                    'category_id' => $categories->where('name', 'Elektronics')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Smart Electronics Ltd.')->first()->id,
                    'created_by' => $admin->id
                ],
                [
                    'name' => 'Wireless Headphones',
                    'description' => 'Noise-cancelling wireless headphones with long battery life.',
                    'price' => 120.00,
                    'quantity' => 200,
                    'category_id' => $categories->where('name', 'Elektronics')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Gadget World')->first()->id,
                    'created_by' => $admin->id
                ],

                // Office Supplies
                [
                    'name' => 'A4 Paper Ream',
                    'description' => 'High-quality A4 paper, perfect for office printers.',
                    'price' => 5.00,
                    'quantity' => 1000,
                    'category_id' => $categories->where('name', 'Office Supplies')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Tech Supplies Co.')->first()->id,
                    'created_by' => $admin->id
                ],
                [
                    'name' => 'Stapler',
                    'description' => 'Heavy-duty stapler for binding large amounts of paper.',
                    'price' => 15.00,
                    'quantity' => 500,
                    'category_id' => $categories->where('name', 'Office Supplies')->first()->id,
                    'supplier_id' => $suppliers->where('name', 'Smart Electronics Ltd.')->first()->id,
                    'created_by' => $admin->id
                ],
            ];

            foreach ($items as $item) {
                Items::create($item); 
            }
        }
    }
}
