<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\TeacherResource;
use App\Models\Student;
use App\Models\Teacher;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditTeacher extends EditRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function resolveRecord(int|string $key): Model
    {
        // Custom logic to retrieve the model
        $teacher = Teacher::with(['user'])->findOrFail($key);

        // You can transform the record here if needed
        $teacher->name = $teacher->user->name;

        return $teacher;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        return DB::transaction(function () use ($record, $data) {
            $user = $record->user;
            $user->username = $data['number'];
            $user->name = $data['name'];
            $user->save();

            unset($data['name']);

            $record->fill($data);
            $record->save();

            return $record;
        });
    }
}
