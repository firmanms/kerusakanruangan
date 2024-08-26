<?php

namespace App\Filament\Resources\MasterruangResource\Pages;

use App\Filament\Resources\MasterruangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterruangs extends ListRecords
{
    protected static string $resource = MasterruangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
