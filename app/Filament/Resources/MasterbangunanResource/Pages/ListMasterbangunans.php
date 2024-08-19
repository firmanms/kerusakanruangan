<?php

namespace App\Filament\Resources\MasterbangunanResource\Pages;

use App\Filament\Resources\MasterbangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterbangunans extends ListRecords
{
    protected static string $resource = MasterbangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
