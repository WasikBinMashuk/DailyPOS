<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = array('Artisan LTD', 'Global Brands', 'ACI');
        $numOfSuppliers = count($suppliers);

        for ($i = 0; $i < $numOfSuppliers; $i++) {
            Supplier::create([
                'supplier_name' => $suppliers[$i],
                'email' => null,
                'mobile' => '0168501051' . $i,
                'address' => 'Mirpur',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
