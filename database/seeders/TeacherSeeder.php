<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherRole = RoleSeeder::teacherRole();

        User::factory(100)->create()->each(function ($user) use ($teacherRole) {
            $user->assignRole($teacherRole);

            $teacher = Teacher::factory()->make();
            $teacher->user_id = $user->id;
            $teacher->save();

            $user->username = $teacher->number;
            $user->save();
        });
    }
}
