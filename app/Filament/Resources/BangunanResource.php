<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BangunanResource\Pages;
use App\Filament\Resources\BangunanResource\RelationManagers;
use App\Models\Bangunan;
use App\Models\Tanah;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class BangunanResource extends Resource
{
    protected static ?string $model = Bangunan::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $navigationLabel = 'Bangunan/Gedung';

    protected static ?string $modelLabel = 'Bangunan/Gedung';

    protected static ?string $pluralLabel = 'Bangunan/Gedung';

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
                                    Forms\Components\Select::make('tanahs_id')
                                        ->label('Tanah')
                                        // ->relationship('Tanahs', 'nama_tanah')
                                        ->options(function () {
                                            $user = auth()->user();

                                            // Jika pengguna adalah super_admin, tampilkan semua tanah
                                            if ($user->role === 'super_admin') {
                                                return Tanah::all()->pluck('nama_tanah', 'id');
                                            }

                                            // Jika bukan super_admin, tampilkan tanah terkait dengan pengguna
                                            return Tanah::where('user_id', $user->id)->pluck('nama_tanah', 'id');
                                        })
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Forms\Components\Select::make('masterbangunans_id')
                                        ->label('Bangunan')
                                        ->relationship('Masterbangunans', 'nama')
                                        ->searchable()
                                        ->preload()
                                        ->required(),
                                    Forms\Components\TextInput::make('nama_bangunan')
                                        ->required()
                                        ->maxLength(255),
                        ])->columns(3),
                        Tabs\Tab::make('Luas')
                                ->schema([
                                    Forms\Components\TextInput::make('panjang')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state, $get) {
                                            $set('luas_tapak', $state * $get('lebar'));
                                        }),
                                    Forms\Components\TextInput::make('lebar')
                                        ->required()
                                        ->numeric()
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set, $state, $get) {
                                            $set('luas_tapak', $state * $get('panjang'));
                                        }),
                                    Forms\Components\TextInput::make('luas_tapak')
                                        ->required()
                                        ->readOnly()
                                        ->numeric(),
                        ])->columns(3),
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
                                    Forms\Components\TextInput::make('nilai_perolehan')
                                        ->required()
                                        ->numeric(),
                        ])->columns(2),
                        Tabs\Tab::make('Info Lainnya')
                                ->schema([
                                    Forms\Components\TextInput::make('jumlah_lantai')
                                        ->required()
                                        ->numeric(),
                                    Forms\Components\TextInput::make('tahun_dibangun')
                                        ->required(),
                                    Forms\Components\TextInput::make('ket')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\DatePicker::make('tgl_sk_pemakai')
                                        ->required(),
                        ])->columns(2),
                        Tabs\Tab::make('NJOP')
                                ->schema([
                                    Forms\Components\TextInput::make('njop')
                                        ->required()
                                        ->numeric(),
                        ])->columns(1),
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
                Tables\Columns\TextColumn::make('tanahs.nama_tanah')
                    ->label('Nama Tanah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterbangunans.nama')
                    ->label('Jenis Bangunan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_bangunan')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('panjang')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lebar')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('luas_tapak')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kepemilikan')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('nilai_perolehan')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_lantai')
                    ->numeric()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('tahun_dibangun'),
                // Tables\Columns\TextColumn::make('ket')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('tgl_sk_pemakai')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('njop')
                    // ->numeric()
                    // ->sortable(),
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
                Action::make('custom_button')
                ->label('F Lt.1')
                ->icon('heroicon-o-document-text')
                ->url(fn ($record) => route('formulirbangunan1', $record->id)) // Mengarahkan ke route
                ->openUrlInNewTab(), // Opsional: Buka di tab baru
                Action::make('custom_button')
                ->label('F Lt.2')
                ->icon('heroicon-o-document-text')
                ->url(fn ($record) => route('formulirbangunan1', $record->id)) // Mengarahkan ke route
                ->openUrlInNewTab(), // Opsional: Buka di tab baru
                Action::make('custom_button')
                ->label('F Lt.3/lebih')
                ->icon('heroicon-o-document-text')
                ->url(fn ($record) => route('formulirbangunan1', $record->id)) // Mengarahkan ke route
                ->openUrlInNewTab(), // Opsional: Buka di tab baru
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
            'index' => Pages\ListBangunans::route('/'),
            'create' => Pages\CreateBangunan::route('/create'),
            'edit' => Pages\EditBangunan::route('/{record}/edit'),
        ];
    }
}
