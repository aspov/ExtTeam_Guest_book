<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // create demo users
        $user1 = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make(12345678)
        ]);
        $user1->assignRole('user');

        $user2 = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin')
        ]);
        $user2->assignRole('admin');
        
    }
}
