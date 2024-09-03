<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanahResource\Pages;
use App\Filament\Resources\TanahResource\RelationManagers;
use App\Models\Masterdesa;
use App\Models\Tanah;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TanahResource extends Resource
{
    protected static ?string $model = Tanah::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $navigationLabel = 'Tanah';

    protected static ?string $modelLabel = 'Tanah';

    protected static ?string $pluralLabel = 'Tanah';

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
                                Forms\Components\TextInput::make('nama_tanah')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('no_sertifikat')
                                    ->required()
                                    ->maxLength(255),
                            ])->columns(2),
                    Tabs\Tab::make('Luas')
                            ->schema([
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
                                Forms\Components\TextInput::make('luas_tersedia')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),
                    Tabs\Tab::make('Kepemilikan')
                            ->schema([
                                Forms\Components\Select::make('kepemilikan')
                                    ->required()
                                    ->options([
                                        'Milik Sendiri' => 'Milik Sendiri',
                                        'Sewa' => 'Sewa',
                                        'Pinjam' => 'Pinjam',
                                        'Bukan Milik' => 'Bukan Milik',
                                    ]),
                                Forms\Components\TextInput::make('ket')
                                    ->required()
                                    ->maxLength(255),
                            ])->columns(2),
                    Tabs\Tab::make('Lokasi')
                            ->schema([
                                Forms\Components\TextInput::make('alamat')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('rt')
                                    ->label('RT')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('rw')
                                    ->label('RW')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('dusun')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Select::make('masterkecamatans_id')
                                    ->label('Kecamatan')
                                    ->relationship('masterkecamatans', 'nama')
                                    ->searchable()
                                    // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(function (Set $set) {
                                        $set('masterdesas_id', null);
                                    })
                                    ->required(),
                                Forms\Components\Select::make('masterdesas_id')
                                    ->label('Desa/Kelurahan')
                                    ->options(fn (Get $get): Collection => Masterdesa::query()
                                        ->where('masterkecamatans_id', $get('masterkecamatans_id'))
                                        ->pluck('nama', 'id'))
                                    ->searchable()
                                    // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                                    ->preload()
                                    ->live()
                                    ->required(),
                                Forms\Components\TextInput::make('kode_pos')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('lat')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('long')
                                    ->required()
                                    ->maxLength(255),
                            ])->columns(3),
                    Tabs\Tab::make('NJOP')
                            ->schema([
                                 Forms\Components\TextInput::make('njop')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_tanah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_sertifikat')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('panjang')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lebar')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('luas')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('luas_tersedia')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kepemilikan')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('ket')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('alamat')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('rt')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('rw')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dusun')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('masterkecamatans.nama')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('masterdesas.nama')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kode_pos')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lat')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('long')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('njop')
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
            'index' => Pages\ListTanahs::route('/'),
            'create' => Pages\CreateTanah::route('/create'),
            'edit' => Pages\EditTanah::route('/{record}/edit'),
        ];
    }
}
