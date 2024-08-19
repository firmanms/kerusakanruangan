<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RuangResource\Pages;
use App\Filament\Resources\RuangResource\RelationManagers;
use App\Models\Masterjenisprasarana;
use App\Models\Ruang;
use Filament\Forms;
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
                Forms\Components\Hidden::make('user_id')
                ->default(Auth::user()->id),
                Forms\Components\Select::make('bangunans_id')
                    ->label('Bangunan')
                    ->required()
                    ->relationship('Bangunans', 'nama_bangunan'),
                Forms\Components\Select::make('masterruangs_id')
                    ->label('Ruang')
                    ->relationship('masterruangs', 'nama')
                    ->searchable()
                    ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
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
                    ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
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
                Forms\Components\TextInput::make('lantai_ke')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('panjang')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lebar')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('luas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('kapasitas')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lplester')

                    ->numeric(),
                Forms\Components\TextInput::make('lplafon')

                    ->numeric(),
                Forms\Components\TextInput::make('ldinding')

                    ->numeric(),
                Forms\Components\TextInput::make('ldaunjendela')

                    ->numeric(),
                Forms\Components\TextInput::make('ldaunpintu')

                    ->numeric(),
                Forms\Components\TextInput::make('lkusen')

                    ->numeric(),
                Forms\Components\TextInput::make('ltutuplantai')

                    ->numeric(),
                Forms\Components\TextInput::make('linstalasilistrik')

                    ->numeric(),
                Forms\Components\TextInput::make('jmlinstalasilistrik')

                    ->numeric(),
                Forms\Components\TextInput::make('pdrainase')

                    ->numeric(),
                Forms\Components\TextInput::make('lfinishstruktur')

                    ->numeric(),
                Forms\Components\TextInput::make('lfinishplafon')

                    ->numeric(),
                Forms\Components\TextInput::make('lfinishdinding')

                    ->numeric(),
                Forms\Components\TextInput::make('lfinishkpj')

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
                Tables\Columns\TextColumn::make('bangunans.nama_bangunan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterruangs.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('masterjenisprasaranas.nama')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_ruang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ruang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registrasi_ruang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lantai_ke')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('panjang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lebar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('luas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kapasitas')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lplester')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lplafon')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ldinding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ldaunjendela')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ldaunpintu')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lkusen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ltutuplantai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('linstalasilistrik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jmlinstalasilistrik')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pdrainase')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lfinishstruktur')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lfinishplafon')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lfinishdinding')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lfinishkpj')
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
            'index' => Pages\ListRuangs::route('/'),
            'create' => Pages\CreateRuang::route('/create'),
            'edit' => Pages\EditRuang::route('/{record}/edit'),
        ];
    }
}
