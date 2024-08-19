<?php

namespace App\Filament\Resources\MasterjenisprasaranaResource\Pages;

use App\Filament\Resources\MasterjenisprasaranaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterjenisprasarana extends EditRecord
{
    protected static string $resource = MasterjenisprasaranaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
