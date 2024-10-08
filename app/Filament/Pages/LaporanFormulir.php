<?php

namespace App\Filament\Pages;

use App\Exports\LaporanFormulirExport;
use App\Models\Formulir;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanFormulir extends Page
{
    use AuthorizesRequests;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Laporan Per Sekolah';

    protected static ?string $title = 'Laporan Kerusakan';

    protected static ?string $navigationLabel = 'Laporan Form Kerusakan';

    protected static ?string $modelLabel = 'Laporan Kerusakan';

    protected static ?string $pluralLabel = 'Laporan Kerusakan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-formulir';

    public $user_id;

    protected function getFormSchema(): array
{
    $user = Auth::user();

    $options = $user->hasRole('super_admin')
        ? Formulir::with('user')->select('user_id')->distinct()->get()
        : Formulir::with('user')->select('user_id')->where('user_id', $user->id)->distinct()->get();

    return [
        Forms\Components\Select::make('user_id')
            ->label('Nama Sekolah')
            ->options(
                $options->mapWithKeys(function ($formulir) {
                    $user = $formulir->user;
                    return $user ? [$formulir->user_id => "{$user->npsn} - {$user->name} - {$user->kecamatan}"] : [];
                })
            )
            ->searchable()
            ->preload()
            ->live()
            ->required(),
    ];
}

    public function submit(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $formulir=$this->user_id;
        // dd($formulir);
        $namasekolah=User::where('id', $formulir)->pluck('name')->first();


        // Export laporan berdasarkan tahun yang dipilih
        return Excel::download(new LaporanFormulirExport($this->user_id), 'laporan_persekolah_'.$namasekolah.'.xlsx');
    }
}
