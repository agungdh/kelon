<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\TeacherResource;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateTeacher extends CreateRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = TeacherResource::class;

    protected function handleRecordCreation(array $data): Teacher
    {
        return DB::transaction(function () use ($data) {
            // Buat user
            $user = User::create([
                'username' => $data['number'],
                'name' => $data['name'],
                'password' => ''
            ]);

            // Tambahkan user_id ke data student
            $data['user_id'] = $user->id;

            unset($data['name']);

            // Buat student dan return
            return Teacher::create($data);
        });
    }
}
