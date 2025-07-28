<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::unguard();

        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'name' => 'super-admin',
                'username' => 'superadmin',
                'password' => 'password', // sẽ được hash qua accessor
                'is_active' => true,
            ]
        );

        // Gán quyền admin nếu chưa gán
        if (! $user->roles->contains($adminRole)) {
            $user->roles()->attach($adminRole);
        }
    }
}
