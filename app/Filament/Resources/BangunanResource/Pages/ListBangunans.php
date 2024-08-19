<?php

namespace App\Filament\Resources\BangunanResource\Pages;

use App\Filament\Resources\BangunanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBangunans extends ListRecords
{
    protected static string $resource = BangunanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
