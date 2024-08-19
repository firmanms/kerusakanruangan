<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BangunanResource\Pages;
use App\Filament\Resources\BangunanResource\RelationManagers;
use App\Models\Bangunan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class BangunanResource extends Resource
{
    protected static ?string $model = Bangunan::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Data';

    protected static ?string $navigationLabel = 'Bangunan';

    protected static ?string $modelLabel = 'Bangunan';

    protected static ?string $pluralLabel = 'Bangunan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\Select::make('tanahs_id')
                    ->label('Tanah')
                    ->relationship('Tanahs', 'nama_tanah')
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
                Forms\Components\TextInput::make('panjang')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lebar')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas_tapak')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kepemilikan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nilai_perolehan')
                    ->required()
                    ->numeric(),
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
                Forms\Components\TextInput::make('njop')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanahs_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterbangunans_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_bangunan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lebar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas_tapak')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kepemilikan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai_perolehan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_lantai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun_dibangun'),
                Tables\Columns\TextColumn::make('ket')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tgl_sk_pemakai')
                    ->searchable(),
                Tables\Columns\TextColumn::make('njop')
                    ->numeric()
                    ->sortable(),
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
            ]);
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
