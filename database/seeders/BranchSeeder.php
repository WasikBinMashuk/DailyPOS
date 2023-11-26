<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = array('Dhanmondi', 'Mirpur', 'Gulshan');
        $numOfbranches = count($branches);

        for ($i = 0; $i < $numOfbranches; $i++) {
            Branch::create([
                'branch_name' => $branches[$i],
                'mobile' => '0168501051' . $i,
                'address' => $branches[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
