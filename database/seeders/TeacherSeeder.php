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
            $user->username = 'U'.$user->id;
            $user->save();

            $user->assignRole($teacherRole);

            $teacher = new Teacher;
            $teacher->user_id = $user->id;
            $teacher->number = 'N'.$user->id;
            $teacher->save();
        });
    }
}
