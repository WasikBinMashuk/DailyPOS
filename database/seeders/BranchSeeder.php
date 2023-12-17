<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $branches = array('Dhanmondi', 'Mirpur', 'Gulshan');
        // $numOfbranches = count($branches);

        // for ($i = 0; $i < $numOfbranches; $i++) {
        //     Branch::create([
        //         'branch_name' => $branches[$i],
        //         'mobile' => '0168501051' . $i,
        //         'address' => $branches[$i],
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }

        $sql = "insert  into `branches`(`id`,`branch_name`,`mobile`,`address`,`default`,`created_at`,`updated_at`) values (1,'Dhanmondi','01685010510','Dhanmondi',1,'2023-11-26 12:28:17','2023-12-07 15:35:48'),(2,'Mirpur','01685010511','Mirpur',0,'2023-11-26 12:28:17','2023-11-26 12:28:17'),(3,'Gulshan','01685010512','Gulshan',0,'2023-11-26 12:28:17','2023-12-07 16:21:57');";

        DB::statement($sql);
    }
}
