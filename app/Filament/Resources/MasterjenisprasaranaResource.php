<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterjenisprasaranaResource\Pages;
use App\Filament\Resources\MasterjenisprasaranaResource\RelationManagers;
use App\Models\Masterjenisprasarana;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasterjenisprasaranaResource extends Resource
{
    protected static ?string $model = Masterjenisprasarana::class;

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $navigationLabel = 'Jenis Prasarana';

    protected static ?string $modelLabel = 'Jenis Prasarana';

    protected static ?string $pluralLabel = 'Jenis Prasarana';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('masterruangs_id')
                    ->label('Masterruangan')
                    ->relationship('Masterruangs', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('detail')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('masterruangs_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('detail')
                    ->searchable(),
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
            'index' => Pages\ListMasterjenisprasaranas::route('/'),
            'create' => Pages\CreateMasterjenisprasarana::route('/create'),
            'edit' => Pages\EditMasterjenisprasarana::route('/{record}/edit'),
        ];
    }
}
