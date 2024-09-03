<?php

namespace App\Filament\Resources\TanahResource\Pages;

use App\Filament\Resources\TanahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListTanahs extends ListRecords
{
    protected static string $resource = TanahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
