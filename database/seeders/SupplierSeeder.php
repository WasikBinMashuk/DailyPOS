<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $suppliers = array('Artisan LTD', 'Global Brands', 'ACI');
        // $numOfSuppliers = count($suppliers);

        // for ($i = 0; $i < $numOfSuppliers; $i++) {
        //     Supplier::create([
        //         'supplier_name' => $suppliers[$i],
        //         'email' => null,
        //         'mobile' => '0168501051' . $i,
        //         'address' => 'Mirpur',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        $sql = "insert  into `suppliers`(`id`,`supplier_name`,`email`,`mobile`,`address`,`created_at`,`updated_at`) values (1,'Artisan LTD',NULL,'01685010510','Mirpur','2023-11-26 12:28:16','2023-11-26 12:28:16'),(2,'Global Brands',NULL,'01685010511','Mirpur','2023-11-26 12:28:16','2023-11-26 12:28:16'),(3,'ACI',NULL,'01685010512','Mirpur','2023-11-26 12:28:16','2023-11-26 12:28:16'),(5,'Bashundhara',NULL,'01625010427','Bashundhara','2023-12-11 12:45:02','2023-12-11 12:45:02');";

        DB::statement($sql);
    }
}
