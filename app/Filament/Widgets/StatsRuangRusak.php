<?php

namespace App\Filament\Widgets;

use App\Models\Formulir;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class StatsRuangRusak extends BaseWidget
{
    protected int|string|array $columnSpan='full';

    protected static ?string $heading = 'Kerusakan Ruangan';

    protected function getTableQuery(): Builder
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Membuat query dasar
        $query = Formulir::with('ruangs.masterruangs') // Memuat relasi
            ->join('ruangs', 'formulirs.ruangs_id', '=', 'ruangs.id')
            ->join('masterruangs', 'ruangs.masterruangs_id', '=', 'masterruangs.id') // Menghubungkan ke masterruangs
            ->selectRaw('ruangs.masterruangs_id,
                masterruangs.nama AS masterruang_nama,
                SUM(CASE WHEN nilai_akhir IS NULL THEN 1 ELSE 0 END) as rusak_tidak_isi,
                SUM(CASE WHEN nilai_akhir <= 30 THEN 1 ELSE 0 END) as rusak_ringan,
                SUM(CASE WHEN nilai_akhir > 30 AND nilai_akhir <= 45 THEN 1 ELSE 0 END) as rusak_sedang,
                SUM(CASE WHEN nilai_akhir > 45 THEN 1 ELSE 0 END) as rusak_berat')
            ->groupBy('ruangs.masterruangs_id', 'masterruangs.nama') // Menambahkan masterruangs.nama dalam group by
            ->orderBy('masterruangs.id'); // Mengurutkan berdasarkan masterruangs.id

        // Memeriksa apakah pengguna adalah super_admin
        if ($user->hasRole('super_admin')) {
            // Jika super_admin, ambil semua data
            return $query->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6]); // Tetap gunakan filter berdasarkan id
        } else {
            // Jika bukan super_admin, ambil data sesuai user_id
            return $query->where('formulirs.user_id', $user->id)
                ->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6]); // Tetap gunakan filter berdasarkan id
        }
    }

    public function getTableRecordKey($record): string // Mengubah akses level menjadi public
    {
        return $record->masterruangs_id; // Pastikan ini adalah kunci unik
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('masterruang_nama') // Pastikan ini sesuai dengan hasil select
                ->label('Jenis Ruang')
                ->sortable(),

            TextColumn::make('rusak_tidak_isi')
                ->label('Belum Diperbarui')
                ->sortable()
                ->formatStateUsing(fn($state) => $state ?? 0),

            TextColumn::make('rusak_ringan')
                ->label('Rusak Ringan')
                ->sortable()
                ->formatStateUsing(fn($state) => $state ?? 0),

            TextColumn::make('rusak_sedang')
                ->label('Rusak Sedang')
                ->sortable()
                ->formatStateUsing(fn($state) => $state ?? 0),

            TextColumn::make('rusak_berat')
                ->label('Rusak Berat')
                ->sortable()
                ->formatStateUsing(fn($state) => $state ?? 0),
        ];
    }
}
