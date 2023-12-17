<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = "insert  into `customers`(`id`,`name`,`email`,`mobile`,`address`,`status`,`created_at`,`updated_at`) values (1,'Rashed','zyduge@mailinator.com','01625010527','Dhanmondi 1/A',1,'2023-11-26 17:05:37','2023-11-29 12:01:26'),(2,'Wasik','wasik@gmail.com','01685010517','Mirpur',1,'2023-11-29 11:42:47','2023-11-29 11:42:47'),(3,'Iqbal Hossain','iqbal@gmail.com','01685010511','Dhaka',1,'2023-11-29 12:00:45','2023-11-29 12:00:45'),(4,'Rabbi','rabbi@gmail.com','01913715980','Dhaka',1,'2023-11-29 12:13:52','2023-11-29 12:13:52');";

        DB::statement($sql);
    }
}
