<?php

namespace App\Filament\Pages;

use App\Exports\LaporanFormulirExport;
use App\Models\Formulir;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Maatwebsite\Excel\Facades\Excel;

class LaporanFormulir extends Page
{
    use AuthorizesRequests;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?string $title = 'Laporan Kerusakan';

    protected static ?string $navigationLabel = 'Laporan Form Kerusakan';

    protected static ?string $modelLabel = 'Laporan Kerusakan';

    protected static ?string $pluralLabel = 'Laporan Kerusakan';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-formulir';

    public $user_id;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('user_id')
                    ->label('Nama Sekolah')
                    // ->relationship('sekolah', 'nama_sekolah')
                    ->options(
                        Formulir::with('user')
                        ->select('user_id') // Select only distinct sekolah IDs
                        ->distinct()
                        ->get()
                        ->mapWithKeys(function ($formulir) {
                            // Get the user for the sekolah_id
                            $user = $formulir->user;

                            // Return only if the user exists to avoid null references
                            return $user ? [$formulir->user_id => "{$user->npsn} - {$user->name} - {$user->kecamatan}"] : [];
                        })
                )
                    ->searchable()
                    // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
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
