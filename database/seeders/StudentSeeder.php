<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            $user->username = 'U' . $user->id;
            $user->save();

            $user->assignRole($studentRole);

            $student = new Student();
            $student->user_id = $user->id;
            $student->number = 'N' . $user->id;
            $student->save();
        });
    }
}
