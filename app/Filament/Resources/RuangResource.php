<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuangResource\Pages;
use App\Filament\Resources\RuangResource\RelationManagers;
use App\Models\Bangunan;
use App\Models\Masterjenisprasarana;
use App\Models\Ruang;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class RuangResource extends Resource
{
    protected static ?string $model = Ruang::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $navigationLabel = 'Ruang';

    protected static ?string $modelLabel = 'Ruang';

    protected static ?string $pluralLabel = 'Ruang';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Informasi')
                                ->schema([
                                    Forms\Components\Hidden::make('user_id')
                                    ->default(Auth::user()->id),
                                    Forms\Components\Select::make('bangunans_id')
                                        ->label('Bangunan')
                                        ->required()
                                        // ->relationship('Bangunans', 'nama_bangunan'),
                                        ->options(function () {
                                            $user = auth()->user();

                                            // Jika pengguna adalah super_admin, tampilkan semua bangunan
                                            if ($user->role === 'super_admin') {
                                                return Bangunan::all()->pluck('nama_bangunan', 'id');
                                            }

                                            // Jika bukan super_admin, tampilkan bangunan terkait dengan pengguna
                                            return Bangunan::where('user_id', $user->id)->pluck('nama_bangunan', 'id');
                                        }),
                                    Forms\Components\Select::make('masterruangs_id')
                                        ->label('Ruang')
                                        ->relationship('masterruangs', 'nama')
                                        ->searchable()
                                        // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                                        ->preload()
                                        ->live()
                                        ->afterStateUpdated(function (Set $set) {
                                            $set('masterjenisprasaranas_id', null);
                                        })
                                        ->required(),
                                    Forms\Components\Select::make('masterjenisprasaranas_id')
                                        ->label('Jenis Prasarana')
                                        ->options(fn (Get $get): Collection => Masterjenisprasarana::query()
                                            ->where('masterruangs_id', $get('masterruangs_id'))
                                            ->pluck('nama', 'id'))
                                        ->searchable()
                                        // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                                        ->preload()
                                        ->live()
                                        ->required(),
                                    Forms\Components\TextInput::make('kode_ruang')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('nama_ruang')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('registrasi_ruang')
                                        ->required()
                                        ->maxLength(255),
                        ])->columns(3),
                        Tabs\Tab::make('Luas')
                                ->schema([
                                    Forms\Components\TextInput::make('lantai_ke')
                                        ->required()
                                        ->numeric(),
                                    Forms\Components\TextInput::make('panjang')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state, $get) {
                                            $set('luas', $state * $get('lebar'));
                                        }),
                                    Forms\Components\TextInput::make('lebar')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state, $get) {
                                            $set('luas', $state * $get('panjang'));
                                        }),
                                    Forms\Components\TextInput::make('luas')
                                        ->required()
                                        ->readOnly()
                                        ->numeric(),
                                    Forms\Components\TextInput::make('kapasitas')
                                        ->required()
                                        ->numeric(),
                        ])->columns(3),
                        Tabs\Tab::make('Luas Lainnya')
                                ->schema([
                                    Forms\Components\TextInput::make('lplester')
                                        ->label('Luas Plester')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lplafon')
                                        ->label('Luas Plafon')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('ldinding')
                                        ->label('Luas Dinding')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('ldaunjendela')
                                        ->label('Luas aun Jendela')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('ldaunpintu')
                                        ->label('Luas Daun Pintu')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lkusen')
                                        ->label('Luas Kusen')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('ltutuplantai')
                                        ->label('Luas Penutup Lantai')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('linstalasilistrik')
// Suggested code may be subject to a license. Learn more: ~LicenseLog:3415997119.
                                        ->label('Luas Instalasi Listrik')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('jmlinstalasilistrik')
                                        ->label('Jumlah Instalasi Listrik')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('pdrainase')
                                        ->label('Luas Drainase')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lfinishstruktur')
// Suggested code may be subject to a license. Learn more: ~LicenseLog:1555202658.
                                        ->label('Luas Finish Struktur')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lfinishplafon')
                                        ->label('Luas Finish Plafon')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lfinishdinding')
                                        ->label('Luas Finish Dinding')
                                        ->numeric(),
                                    Forms\Components\TextInput::make('lfinishkpj')
                                    ->label('Luas Finish Kpj')
                                        ->numeric(),

                        ])->columns(3),
                    ])->columnSpanFull(),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.npsn')
                    ->label('NPSN')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Sekolah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.kecamatan')
                    ->label('Kecamatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bangunans.nama_bangunan')
                    ->label('Nama Bangunan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterruangs.nama')
                    ->label('Jenis Ruangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterjenisprasaranas.nama')
                    ->label('Jenis Prasarana')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('kode_ruang')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('nama_ruang')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('registrasi_ruang')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('lantai_ke')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('panjang')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lebar')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('luas')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kapasitas')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lplester')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lplafon')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('ldinding')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('ldaunjendela')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('ldaunpintu')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lkusen')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('ltutuplantai')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('linstalasilistrik')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jmlinstalasilistrik')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pdrainase')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lfinishstruktur')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lfinishplafon')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lfinishdinding')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lfinishkpj')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $userId = Auth::id();
                // Asumsikan bahwa pengguna memiliki metode atau properti untuk mendapatkan role
                $roles = Auth::user()->roles->pluck('name'); // Atau metode lain jika berbeda
                $roleNames = $roles->implode(', ');
                if ($roleNames=='super_admin'){
                    return $query;
                }else{
                return $query->where('user_id' ,$userId);
                }
            });
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRuangs::route('/'),
            'create' => Pages\CreateRuang::route('/create'),
            'edit' => Pages\EditRuang::route('/{record}/edit'),
        ];
    }
}
