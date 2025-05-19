<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreateStudent extends CreateRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = StudentResource::class;

    protected function handleRecordCreation(array $data): Student
    {
        return DB::transaction(function () use ($data) {
            // Buat user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'), // Ganti sesuai kebutuhan
            ]);

            // Tambahkan user_id ke data student
            $data['user_id'] = $user->id;

            // Buat student dan return
            return Student::create($data);
        });
    }
}
