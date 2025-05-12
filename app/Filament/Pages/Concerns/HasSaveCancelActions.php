<?php

namespace App\Filament\Pages\Concerns;

use Filament\Actions\Action;

trait HasSaveCancelActions
{
    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->submit('save')
                ->color('primary'),

            Action::make('cancel')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}
