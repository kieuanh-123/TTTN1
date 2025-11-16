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
        $adminRole = Role::where('name', 'admin')->first();
        
        if (!$adminRole) {
            $adminRole = Role::create(['name' => 'admin']);
        }
        
        $admin = User::firstOrCreate(
            ['email' => 'admin@tma.com'],
            [
                'name' => 'Admin TMA',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );
        
        // Đảm bảo admin luôn có role_id và email_verified_at đúng
        $admin->update([
            'role_id' => $adminRole->id,
            'email_verified_at' => $admin->email_verified_at ?? now(),
        ]);
        
        // Reset password về admin123 nếu cần (để test)
        // Uncomment dòng dưới nếu muốn reset password mỗi lần seed
        // $admin->update(['password' => Hash::make('admin123')]);
        
        if ($admin->wasRecentlyCreated) {
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@tma.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists.');
            $this->command->info('Email: admin@tma.com');
            $this->command->info('Role ID: ' . $admin->role_id);
            $this->command->info('Email Verified: ' . ($admin->email_verified_at ? 'Yes' : 'No'));
        }
    }
}


