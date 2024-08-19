<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MasterruangResource\Pages;
use App\Filament\Resources\MasterruangResource\RelationManagers;
use App\Models\Masterruang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MasterruangResource extends Resource
{
    protected static ?string $model = Masterruang::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $navigationLabel = 'Jenis Ruangan';

    protected static ?string $modelLabel = 'Jenis Ruangan';

    protected static ?string $pluralLabel = 'Jenis Ruangan';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            'index' => Pages\ListMasterruangs::route('/'),
            'create' => Pages\CreateMasterruang::route('/create'),
            'edit' => Pages\EditMasterruang::route('/{record}/edit'),
        ];
    }
}
