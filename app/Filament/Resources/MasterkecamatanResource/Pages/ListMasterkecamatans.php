<?php

namespace App\Filament\Resources\MasterkecamatanResource\Pages;

use App\Filament\Resources\MasterkecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterkecamatans extends ListRecords
{
    protected static string $resource = MasterkecamatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
