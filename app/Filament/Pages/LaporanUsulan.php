<?php

namespace App\Filament\Pages;

use App\Exports\LaporanUsulanExport;
use App\Models\User;
use App\Models\Usulanrehab;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LaporanUsulan extends Page
{
    use AuthorizesRequests;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Laporan Per Sekolah';

    protected static ?string $title = 'Laporan Usulan';

    protected static ?string $navigationLabel = 'Laporan Usulan';

    protected static ?string $modelLabel = 'Laporan Usulan';

    protected static ?string $pluralLabel = 'Laporan Usulan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-usulan';

    public $user_id;

    protected function getFormSchema(): array
{
    $user = Auth::user();

    $options = $user->hasRole('super_admin')
        ? Usulanrehab::with('user')->select('user_id')->distinct()->get()
        : Usulanrehab::with('user')->select('user_id')->where('user_id', $user->id)->distinct()->get();

    return [
        Select::make('user_id')
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
        return Excel::download(new LaporanUsulanExport($this->user_id), 'laporan_usulan_sekolah_'.$namasekolah.'.xlsx');
    }
}
