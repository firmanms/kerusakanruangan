<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsulanrehabResource\Pages;
use App\Filament\Resources\UsulanrehabResource\RelationManagers;
use App\Models\Bangunan;
use App\Models\Ruang;
use App\Models\Usulanrehab;
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
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class UsulanrehabResource extends Resource
{
    protected static ?string $model = Usulanrehab::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Usulan';

    protected static ?string $navigationLabel = 'Usulan Rehab';

    protected static ?string $modelLabel = 'Usulan Rehab';

    protected static ?string $pluralLabel = 'Usulan Rehab';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::user()->id),
                Forms\Components\Select::make('bangunans_id')
                    ->label('Bangunan')
                    // ->relationship('bangunans', 'nama_bangunan')
                    ->options(function () {
                        $user = auth()->user();

                        // Jika pengguna adalah super_admin, tampilkan semua bangunan
                        if ($user->role === 'super_admin') {
                            return Bangunan::all()->pluck('nama_bangunan', 'id');
                        }

                        // Jika bukan super_admin, tampilkan bangunan terkait dengan pengguna
                        return Bangunan::where('user_id', $user->id)->pluck('nama_bangunan', 'id');
                    })
                    ->searchable()
                    // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('ruangs_id', null);
                    })
                    ->required(),
                Forms\Components\Select::make('ruangs_id')
                    ->label('Ruang')
                    ->options(fn (Get $get): Collection => Ruang::query()
                        ->where('bangunans_id', $get('bangunans_id'))
                        ->pluck('nama_ruang', 'id'))
                    ->searchable()
                    // ->disabled(fn ($record) => $record ? $record->exists : false) // Menandai sebagai disabled jika record ada
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\Select::make('jenis_usulan')
                    ->required()
                    ->options([
                        'Ringan'=>'Ringan',
                        'Sedang'=>'Sedang',
                        'Berat' =>'Berat',
                    ]),
                Forms\Components\FileUpload::make('surat')
                    ->label('Surat Usulan .PDF')
                    ->required()
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('srat/'.Auth::user()->id)
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return (string) str($file->getClientOriginalName())->prepend(now()->timestamp);
                        }),
                PdfViewerField::make('file')
                        ->label('View the PDF')
                        ->minHeight('40svh'),
                Forms\Components\FileUpload::make('denah')
                    ->label('Gambar Denah (jpg,png)')
                    ->required()
                    ->image()
                    ->directory('denah/'.Auth::user()->id)
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return (string) str($file->getClientOriginalName())->prepend(now()->timestamp);
                        }),
                Forms\Components\TextInput::make('ket')
                    ->label('Keterangan')
                    ->required()
                    ->maxLength(255),
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
                    ->label('Nama Bangunan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ruangs.nama_ruang')
                    ->label('Nama Ruangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_usulan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ket')
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
            'index' => Pages\ListUsulanrehabs::route('/'),
            'create' => Pages\CreateUsulanrehab::route('/create'),
            'edit' => Pages\EditUsulanrehab::route('/{record}/edit'),
        ];
    }
}
