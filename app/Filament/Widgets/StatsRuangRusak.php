<?php

namespace App\Filament\Widgets;

use App\Models\Formulir;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsRuangRusak extends BaseWidget
{
    public function getRusakData()
    {
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data usulan
        if (auth()->user()->hasRole('super_admin')) {
            return Formulir::all();
        }


        // Jika pengguna biasa, tampilkan data usulan sesuai dengan user_id
        return Formulir::where('user_id', $user->id)->get();
    }

    protected function getStats(): array
    {
        $RuangrusakData = $this->getRusakData();
        $totalRingan=$RuangrusakData->where('nilai_akhir', '<=', 30 )->count();
        $totalSedang=$RuangrusakData->where('nilai_akhir', '>', 30)->where('nilai_akhir', '<=', 45)->count();
        $totalBerat=$RuangrusakData->where('nilai_akhir', '>', 45 )->count();
        return [
            Stat::make('Ruang Rusak Ringan', $totalRingan)
            ->color('success'),
            Stat::make('Ruang Rusak Sedang', $totalSedang)
            ->color('warning'),
            Stat::make('Ruang Rusak Berat', $totalBerat)
            ->color('danger'),
        ];
    }
}
