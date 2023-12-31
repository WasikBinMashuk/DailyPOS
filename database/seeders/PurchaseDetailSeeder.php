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
    $sql = "INSERT INTO `purchase_details` 
    (`id`, `purchase_id`, `product_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) 
    VALUES 
    (1, 1, 9, 10, '2500', '25000', '2023-11-26 12:29:40', '2023-11-26 12:29:40'),
    (2, 1, 31, 10, '2200', '22000', '2023-11-26 12:29:40', '2023-11-26 12:29:40'),
    (3, 2, 11, 10, '122', '1220', '2023-11-26 12:33:01', '2023-11-26 12:33:01'),
    (4, 2, 35, 10, '400', '4000', '2023-11-26 12:33:01', '2023-11-26 12:33:01'),
    (5, 3, 21, 10, '200', '2000', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
    (6, 3, 20, 10, '120', '1200', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
    (7, 3, 28, 10, '2200', '22000', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
    (8, 3, 8, 10, '100', '1000', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
    (9, 3, 60, 10, '100', '1000', '2023-11-26 12:40:46', '2023-11-26 12:40:46'),
    (12, 5, 39, 10, '65005', '650050', '2023-11-28 10:58:43', '2023-11-28 10:58:43'),
    (16, 8, 68, 10, '20', '200', '2023-12-11 12:42:10', '2023-12-11 12:42:10'),
    (17, 9, 69, 10, '120', '1200', '2023-12-11 12:51:01', '2023-12-11 12:51:01'),
    (20, 11, 34, 10, '600', '6000', '2023-12-12 17:02:46', '2023-12-12 17:02:46');";

    DB::statement($sql);
  }
}
