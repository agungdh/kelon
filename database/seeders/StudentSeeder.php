<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentRole = RoleSeeder::studentRole();

        User::factory(100)->create()->each(function ($user) use ($studentRole) {
            $user->assignRole($studentRole);

            $student = Student::factory()->make();
            $student->user_id = $user->id;
            $student->save();

            $user->username = $student->number;
            $user->save();
        });
    }
}
