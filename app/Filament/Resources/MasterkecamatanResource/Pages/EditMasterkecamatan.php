<?php

namespace App\Filament\Resources\MasterkecamatanResource\Pages;

use App\Filament\Resources\MasterkecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterkecamatan extends EditRecord
{
    protected static string $resource = MasterkecamatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
