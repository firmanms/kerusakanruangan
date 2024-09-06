<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SopPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.sop-page';

    protected static ?string $navigationLabel = 'SOP';
}
