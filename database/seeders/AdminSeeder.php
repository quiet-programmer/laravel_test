<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminCount = max((int)$this->command->ask('How many admin do you want to create?', 10), 1);
        Admin::factory()->defaultAdminDetails()->create();
        Admin::factory()->count($adminCount)->create();
    }
}
