<?php

namespace App\Filament\Resources\MasterdesaResource\Pages;

use App\Filament\Resources\MasterdesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterdesas extends ListRecords
{
    protected static string $resource = MasterdesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
