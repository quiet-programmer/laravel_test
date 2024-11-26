<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if ($this->command->confirm('Do you want to refresh the Database?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database has been refreshed');
        }

        $this->call([
            AdminSeeder::class,
            // EventRequestSeeder::class,
            // AttendeeSeeder::class,
            // SpeakerSeeder::class,
            // NotificationSeeder::class,
            // LineManagerSeeder::class,
            // TagsSeeder::class,
        ]);
    }
}
