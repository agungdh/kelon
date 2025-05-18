<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'student',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'teacher',
            'guard_name' => 'web',
        ]);
    }

    public static function superAdminRole(): Role
    {
        return Role::where('name', 'super_admin')->first();
    }

    public static function studentRole(): Role
    {
        return Role::where('name', 'student')->first();
    }

    public static function teacherRole(): Role
    {
        return Role::where('name', 'teacher')->first();
    }
}
