<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "INSERT INTO `purchases`
        (`id`,`supplier_id`,`branch_id`,`date`,`status`,`payment_method`,`subtotal`,`created_at`,`updated_at`) 
        VALUES 
        (1,1,1,'2023-11-26','received','cod','4700','2023-11-26 12:29:40','2023-11-26 12:30:09'),
        (2,2,3,'2023-11-24','received','online','922','2023-11-26 12:33:01','2023-11-26 12:33:01'),
        (3,1,1,'2023-11-23','received','cod','20360','2023-11-26 12:40:46','2023-11-26 12:40:46'),
        (5,2,1,'2023-11-28','received','cod','65005','2023-11-28 10:58:43','2023-11-28 10:58:57'),
        (8,5,1,'2023-12-11','received','cod','400','2023-12-11 12:42:10','2023-12-11 12:45:13'),
        (9,3,2,'2023-12-11','received','cod','3600','2023-12-11 12:51:01','2023-12-11 12:51:31'),
        (11,2,1,'2023-12-12','received','cod','6000','2023-12-12 17:02:46','2023-12-12 17:02:46');";

        DB::statement($sql);
    }
}
