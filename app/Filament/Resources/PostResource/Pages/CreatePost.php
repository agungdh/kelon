<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Pages\Concerns\HasRedirectToIndex;
use App\Filament\Pages\Concerns\HasSaveCancelActions;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    use HasRedirectToIndex, HasSaveCancelActions;

    protected static string $resource = PostResource::class;
}
