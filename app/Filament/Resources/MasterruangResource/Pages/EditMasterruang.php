<?php

namespace App\Filament\Resources\MasterruangResource\Pages;

use App\Filament\Resources\MasterruangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterruang extends EditRecord
{
    protected static string $resource = MasterruangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
