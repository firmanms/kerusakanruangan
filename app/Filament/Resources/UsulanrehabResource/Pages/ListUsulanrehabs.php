<?php

namespace App\Filament\Resources\UsulanrehabResource\Pages;

use App\Filament\Resources\UsulanrehabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulanrehabs extends ListRecords
{
    protected static string $resource = UsulanrehabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
