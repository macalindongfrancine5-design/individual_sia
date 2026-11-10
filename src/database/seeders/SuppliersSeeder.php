<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Suppliers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $admin = Admin::first();

         if ($admin) {
             $suppliers = [
                 [
                     'name' => 'Tech Supplies Co.',
                     'contact_info' => '0823232323',
                     'created_by' => $admin->id
                 ],
                 [
                     'name' => 'Gadget World',
                     'contact_info' => '0833434343434',
                     'created_by' => $admin->id
                 ],
                 [
                     'name' => 'Smart Electronics Ltd.',
                     'contact_info' => '082121212122',
                     'created_by' => $admin->id
                 ]
             ];
 
             foreach ($suppliers as $supplier) {
                 Suppliers::create($supplier); 
             }
         }
    }
}
