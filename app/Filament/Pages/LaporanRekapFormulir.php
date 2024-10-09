<?php

namespace App\Filament\Pages;

use App\Exports\LaporanRekapFormulirExport;
use Filament\Pages\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Maatwebsite\Excel\Facades\Excel;

class LaporanRekapFormulir extends Page
{
    use AuthorizesRequests;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Laporan Rekap';

    protected static ?string $title = 'Laporan Kerusakan';

    protected static ?string $navigationLabel = 'Laporan Form Kerusakan';

    protected static ?string $modelLabel = 'Laporan Kerusakan';

    protected static ?string $pluralLabel = 'Laporan Kerusakan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-rekap-formulir';

    public function submit(): \Symfony\Component\HttpFoundation\BinaryFileResponse
{
    $currentDate = now()->format('d-m-Y');

    // Generate the filename with the current date
    $filename = "laporanrekapformulir_{$currentDate}.xlsx";

    return Excel::download(new LaporanRekapFormulirExport, $filename);
}
}
