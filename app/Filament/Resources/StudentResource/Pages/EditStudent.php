<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\StudentResource;
use App\Models\Student;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditStudent extends EditRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function resolveRecord(int|string $key): Model
    {
        // Custom logic to retrieve the model
        $student = Student::with(['user'])->findOrFail($key);

        // You can transform the record here if needed
        $student->name = $student->user->name;

        return $student;
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
