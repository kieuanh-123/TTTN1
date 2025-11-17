<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo hoặc lấy role admin
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
        );

        // Tạo hoặc lấy admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@tma.com'],
            [
                'name' => 'Admin TMA',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );

        // Đảm bảo role_id đúng theo role name
        if ($admin->role_id !== $adminRole->id) {
            $admin->update(['role_id' => $adminRole->id]);
        }

        // Log kết quả
        if ($admin->wasRecentlyCreated) {
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@tma.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists.');
            $this->command->info('Email: admin@tma.com');
            $this->command->info('Role: ' . ($admin->role->name ?? 'N/A'));
            $this->command->info('Email Verified: ' . ($admin->email_verified_at ? 'Yes' : 'No'));
        }
    }
}
