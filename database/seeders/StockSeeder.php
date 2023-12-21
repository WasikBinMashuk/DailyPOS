<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $sql = "INSERT INTO `stocks` 
        (`id`, `product_id`, `branch_id`, `source`, `quantity`, `date`, `created_at`, `updated_at`) 
        VALUES 
        (1, 9, 1, 'supplier', 10, '2023-11-26', '2023-11-26 12:30:09', '2023-11-26 12:30:09'),
        (2, 31, 1, 'supplier', 10, '2023-11-26', '2023-11-26 12:30:09', '2023-11-26 12:30:09'),
        (3, 11, 3, 'supplier', 10, '2023-11-24', '2023-11-26 12:33:01', '2023-11-26 12:33:01'),
        (4, 35, 3, 'supplier', 10, '2023-11-24', '2023-11-26 12:33:01', '2023-11-26 12:33:01'),
        (5, 21, 1, 'supplier', 10, '2023-11-23', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
        (6, 20, 1, 'supplier', 10, '2023-11-23', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
        (7, 28, 1, 'supplier', 10, '2023-11-23', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
        (8, 8, 1, 'supplier', 10, '2023-11-23', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
        (9, 60, 1, 'supplier', 10, '2023-11-23', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
        (12, 39, 1, 'supplier', 10, '2023-11-28', '2023-11-28 10:58:57', '2023-11-28 10:58:57'),
        (14, 22, 1, 'supplier', 10, '2023-11-23', '2023-12-06 11:54:57', '2023-12-06 11:54:57'),
        (16, 68, 1, 'supplier', 10, '2023-12-11', '2023-12-11 12:42:10', '2023-12-11 12:42:10'),
        (17, 69, 2, 'supplier', 10, '2023-12-11', '2023-12-11 12:51:31', '2023-12-11 12:51:31'),
        (19, 19, 1, 'supplier', 10, '2023-12-12', '2023-12-12 17:01:38', '2023-12-12 17:01:38'),
        (20, 34, 1, 'supplier', 10, '2023-12-12', '2023-12-12 17:02:46', '2023-12-12 17:02:46');";

        DB::statement($sql);
    }
}
