<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "insert  into `purchase_details`(`id`,`purchase_id`,`product_id`,`quantity`,`price`,`total_price`,`created_at`,`updated_at`) values (1,1,9,1,'2500','2500','2023-11-26 12:29:40','2023-11-26 12:29:40'),(2,1,31,1,'2200','2200','2023-11-26 12:29:40','2023-11-26 12:29:40'),(3,2,11,1,'122','122','2023-11-26 12:33:01','2023-11-26 12:33:01'),(4,2,35,2,'400','800','2023-11-26 12:33:01','2023-11-26 12:33:01'),(5,3,21,1,'200','200','2023-11-26 12:40:46','2023-11-26 12:40:46'),(6,3,20,8,'120','960','2023-11-26 12:40:46','2023-11-26 12:40:46'),(7,3,28,6,'2200','13200','2023-11-26 12:40:46','2023-11-26 12:40:46'),(8,3,8,50,'100','5000','2023-11-26 12:40:46','2023-11-26 12:40:46'),(9,3,60,10,'100','1000','2023-11-26 12:40:46','2023-11-26 12:40:46'),(10,4,21,1,'200','200','2023-11-26 12:54:58','2023-11-26 12:54:58'),(11,4,20,2,'120','240','2023-11-26 12:54:58','2023-11-26 12:54:58'),(12,5,39,1,'65005','65005','2023-11-28 10:58:43','2023-11-28 10:58:43'),(13,6,35,2,'400','800','2023-11-30 14:51:51','2023-11-30 14:51:51'),(14,6,22,1,'2000','2000','2023-11-30 14:51:51','2023-11-30 14:51:51'),(15,7,9,10,'2500','25000','2023-12-07 17:42:21','2023-12-07 17:42:21'),(16,8,68,20,'20','400','2023-12-11 12:42:10','2023-12-11 12:42:10'),(17,9,69,30,'120','3600','2023-12-11 12:51:01','2023-12-11 12:51:01'),(18,10,11,10,'122','1220','2023-12-12 17:01:38','2023-12-12 17:01:38'),(19,10,19,10,'1200','12000','2023-12-12 17:01:38','2023-12-12 17:01:38'),(20,11,34,10,'600','6000','2023-12-12 17:02:46','2023-12-12 17:02:46');";

        DB::statement($sql);
    }
}