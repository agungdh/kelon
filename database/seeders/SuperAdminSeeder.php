<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = RoleSeeder::superAdminRole();

        User::factory(1)->create()->each(function ($user) use ($superAdminRole) {
            $user->username = 'admin';
            $user->save();

            $user->assignRole($superAdminRole);

            $superAdmin = new SuperAdmin;
            $superAdmin->user_id = $user->id;
            $superAdmin->save();
        });
    }
}
