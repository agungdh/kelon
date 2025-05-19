<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\StudentResource;
use App\Models\Student;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Str;

class CreateStudent extends CreateRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = StudentResource::class;

    protected function handleRecordCreation(array $data): Student
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
            return Student::create($data);
        });
    }
}
