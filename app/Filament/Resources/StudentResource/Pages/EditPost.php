<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
