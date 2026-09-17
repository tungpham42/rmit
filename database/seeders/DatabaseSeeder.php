<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Enums\RoleName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        foreach (RoleName::cases() as $role) {
            Role::firstOrCreate(['role_name' => $role->value]);
        }

        User::factory()->create([
            'name' => 'Tung Pham',
            'email' => 'tung.42@gmail.com',
            'password' => Hash::make('rm!t29190'),
            'role_id' => Role::where('role_name', RoleName::Admin->value)->first()?->role_id,
        ]);
    }
}
