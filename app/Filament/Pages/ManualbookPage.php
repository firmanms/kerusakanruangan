<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ManualbookPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.manualbook-page';

    protected static ?string $navigationLabel = 'Buku Petunjuk';
}
