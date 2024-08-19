<?php

namespace App\Filament\Resources\MasterbangunanResource\Pages;

use App\Filament\Resources\MasterbangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterbangunan extends EditRecord
{
    protected static string $resource = MasterbangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
