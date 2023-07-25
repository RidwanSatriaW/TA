<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'type' => 'Admin',
            'status' =>1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Irfan',
            'email' => 'irfan@gmail.com',
            'password' => Hash::make('irfan123'),
            'type' => 'User',
            'status' =>1
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Ridwan',
            'email' => 'ridwan@gmail.com',
            'password' => Hash::make('ridwan123'),
            'type' => 'User',
            'status' =>1
        ]);
        \App\Models\Keperluan::create([
            'keperluan_name' => 'Melamar Kerja',
            'status' => 1,
        ]);
        \App\Models\Keperluan::create([
            'keperluan_name' => 'Wawancara',
            'status' => 1,
        ]);
        \App\Models\Keperluan::create([
            'keperluan_name' => 'Kerja Sama',
            'status' => 1,
        ]);
        \App\Models\Department::create([
            'department_name' => 'HRD',
            'status' => 1,
        ]);
        \App\Models\Department::create([
            'department_name' => 'Marketing',
            'status' => 1,
        ]);
        \App\Models\Department::create([
            'department_name' => 'IT',
            'status' => 1,
        ]);
    }
}
