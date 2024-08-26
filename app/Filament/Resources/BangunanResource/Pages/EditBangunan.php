<?php

namespace App\Filament\Resources\BangunanResource\Pages;

use App\Filament\Resources\BangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBangunan extends EditRecord
{
    protected static string $resource = BangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
