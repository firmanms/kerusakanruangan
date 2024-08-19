<?php

namespace App\Filament\Resources\MasterdesaResource\Pages;

use App\Filament\Resources\MasterdesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterdesa extends EditRecord
{
    protected static string $resource = MasterdesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
