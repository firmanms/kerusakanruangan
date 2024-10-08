<?php

namespace App\Filament\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class Users extends BaseWidget
{
    use HasWidgetShield;

    protected int|string|array $columnSpan='full';

    protected static ?string $heading = 'Keterisian Data';

    public function table(Table $table): Table
    {
        $user = auth()->user(); // Get the currently authenticated user

        // Initialize the query
        $data = DB::table('masterruangs')
    ->join('ruangs', 'masterruangs.id', '=', 'ruangs.masterruangs_id')
    ->join('formulirs', 'ruangs.id', '=', 'formulirs.ruangs_id')
    ->select('masterruangs.nama', 'ruangs.nama_ruang', 'formulirs.nilai_akhir')
    ->where('formulirs.user_id', $user->id)
    ->get()
    ->groupBy('nama');
    // dd($data);
        $query = User::where('jenjang','SD')->withCount(['tanah', 'bangunan', 'ruang'])->orderby('kecamatan','asc');

        // Filter based on user role and kecamatan
        if ($user->hasRole('super_admin')) {
            // Super admin can see all users
        } else {
            // Regular users see only their kecamatan
            $query->where('kecamatan', $user->kecamatan);
        }

        return $table
        ->defaultGroup('kecamatan')
        ->query($query) // This will add a 'tanah_count' attribute
        ->columns([
            TextColumn::make('npsn')
                ->label('NPSN')
                ->searchable()
                ->sortable(),
            TextColumn::make('name')
                ->label('Nama Sekolah')
                ->searchable()
                ->sortable(),

            TextColumn::make('kecamatan')
                ->label('Kecamatan')
                ->searchable()
                ->sortable(),

            TextColumn::make('tanah_count')
                ->label('Jml Tanah')
                ->sortable(),

            TextColumn::make('bangunan_count')
                ->label('Jml Bangunan')
                ->sortable(),

            TextColumn::make('ruang_count')
                ->label('Jml Ruangan')
                ->sortable(),


            ]);
    }
}
