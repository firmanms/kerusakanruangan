<?php

namespace App\Filament\Widgets;

use App\Models\Formulir;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsRuangArusak extends BaseWidget
{
    // Set columns to full width
    protected int|string|array $columnSpan = 'full';

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
        $total = $RuangrusakData->count();

        return [
            Stat::make('Total Ruangan yang telah input formulir', $total)
                ->color('success'),
        ];
    }
}
