<?php

namespace App\Filament\Pages;

use App\Exports\LaporanRekapUsulanExport;
use Filament\Pages\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Maatwebsite\Excel\Facades\Excel;

class LaporanRekapUsulan extends Page
{
    use AuthorizesRequests;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Laporan Rekap';

    protected static ?string $title = 'Laporan Usulan';

    protected static ?string $navigationLabel = 'Laporan Usulan';

    protected static ?string $modelLabel = 'Laporan Usulan';

    protected static ?string $pluralLabel = 'Laporan Usulan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-rekap-usulan';

    public function submit(): \Symfony\Component\HttpFoundation\BinaryFileResponse
{
    $currentDate = now()->format('d-m-Y');

    // Generate the filename with the current date
    $filename = "laporanrekapusulan_{$currentDate}.xlsx";

    return Excel::download(new LaporanRekapUsulanExport, $filename);
}
}
