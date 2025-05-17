<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        $studentRole = Role::create([
            'name' => 'student',
            'guard_name' => 'web',
        ]);

        $teacherRole = Role::create([
            'name' => 'teacher',
            'guard_name' => 'web',
        ]);

        User::factory(10)->create()->each(function ($user) use ($studentRole) {;
            $user->assignRole($studentRole);

            $student = Student::factory()->make();
            $student->user_id = $user->id;
            $student->save();
        });

        User::factory(10)->create()->each(function ($user) use ($teacherRole) {;
            $user->assignRole($teacherRole);

            $teacher = Teacher::factory()->make();
            $teacher->user_id = $user->id;
            $teacher->save();
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole($superAdminRole);
    }
}
