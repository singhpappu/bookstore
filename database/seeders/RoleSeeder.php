<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'customer']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('Secret@2023'),
        ]);

        $user->assignRole($admin);
    }
}
