<?php

namespace App\Filament\Resources\MasterjenisprasaranaResource\Pages;

use App\Filament\Resources\MasterjenisprasaranaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterjenisprasaranas extends ListRecords
{
    protected static string $resource = MasterjenisprasaranaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
