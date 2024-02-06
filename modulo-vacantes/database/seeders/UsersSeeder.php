<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'last_name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::where('name', 'admin')->first();
        $user->assignRole($role);
    }
}
