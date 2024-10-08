<?php

namespace App\Filament\Widgets;

use App\Models\Usulanrehab;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsUsula extends BaseWidget
{
    public function getUsulanData()
    {
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data usulan
        if (auth()->user()->hasRole('super_admin')) {
            return Usulanrehab::all();
        }


        // Jika pengguna biasa, tampilkan data usulan sesuai dengan user_id
        return Usulanrehab::where('user_id', $user->id)->get();
    }

    protected function getStats(): array
    {
        $usulanData = $this->getUsulanData()->count();
        return [
            Stat::make('Total Usulan', $usulanData)
            ->color('success'),

        ];
    }
}
