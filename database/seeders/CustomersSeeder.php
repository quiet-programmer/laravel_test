<?php

namespace Database\Seeders;

use App\Models\Customers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminCount = max((int)$this->command->ask('How many customers do you want to create?', 10), 1);
        Customers::factory()->count($adminCount)->create();
    }
}
