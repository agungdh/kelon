<?php

namespace App\Filament\Pages\Concerns;

trait HasRedirectToIndex
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
