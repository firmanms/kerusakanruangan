<?php

namespace App\Filament\Widgets;

use App\Models\Bangunan;
use App\Models\Ruang;
use App\Models\Tanah;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    public function getTanahData()
    {
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data tanah
        if (auth()->user()->hasRole('super_admin')) {
            return Tanah::all();
        }


        // Jika pengguna biasa, tampilkan data tanah sesuai dengan user_id
        return Tanah::where('user_id', $user->id)->get();
    }

    public function getBangunanData()
    {
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data Bangunan
        if (auth()->user()->hasRole('super_admin')) {
            return Bangunan::all();
        }


        // Jika pengguna biasa, tampilkan data Bangunan sesuai dengan user_id
        return Bangunan::where('user_id', $user->id)->get();
    }

    public function getRuangData()
    {
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data Ruang
        if (auth()->user()->hasRole('super_admin')) {
            return Ruang::all();
        }


        // Jika pengguna biasa, tampilkan data Ruang sesuai dengan user_id
        return Ruang::where('user_id', $user->id)->get();
    }
    protected function getStats(): array
    {
        $tanahData = $this->getTanahData();
        $bangunanData = $this->getBangunanData();
        $ruangData  = $this->getRuangData();

        $totalTanah = $tanahData->count();
        $totalBangunan = $bangunanData->count();
        $totalRuang = $ruangData->count();

        return [
            Stat::make('Data Tanah', $totalTanah),
            Stat::make('Data Bangunan', $totalBangunan),
            Stat::make('Data Ruangan', $totalRuang),
        ];
    }
}
