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
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

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
                    ->default(Auth::user()->id) // Mengatur user_id ke ID pengguna saat ini
                    ->disabled(fn ($record) => $record !== null), // Field tidak dapat diubah saat pengeditan
                    //->visible(fn () => false), // Field tidak ditampilkan di form

                Forms\Components\DatePicker::make('tgl_pengajuan')
                    ->label('Tanggal Pengajuan')
                    ->required(),
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
                    ->label('Surat Usulan .PDF  Maks 2 Mb')
                    ->required()
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('surat/'.Auth::user()->id)
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return now()->timestamp . '-' . $file->getClientOriginalName(); // Gabungkan timestamp dengan nama file asli
                    }),
                Forms\Components\FileUpload::make('denah')
                    ->label('Gambar Denah (jpg,png) Maks 2 Mb')
                    ->required()
                    ->image()
                    ->directory('denah/'.Auth::user()->id)
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            return now()->timestamp . '-' . $file->getClientOriginalName();
                        }),
                    Forms\Components\FileUpload::make('kondisi_ruangan')
                        ->label('Foto Kondisi Ruangan (jpg,png) (Maks 2 Foto) (Maks 2Mb)')
                        ->image()
                        ->directory('kondisi_ruangan/'.Auth::user()->id)
                        ->multiple()
                        ->maxFiles(2)
                        ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                            return now()->timestamp . '-' . $file->getClientOriginalName();
                        }),
                Forms\Components\TextInput::make('ket')
                    ->label('Keterangan')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'process' => 'Proses',
                        'success' => 'Diterima',
                        'danger' => 'Ditolak',
                    ])
                    ->visible(fn () => auth()->user()->hasRole('super_admin')), // Menampilkan hanya untuk super_admin

            ]);
    }

    public static function create(array $data)
    {
        // Set user_id secara eksplisit saat membuat record baru
        $data['user_id'] = Auth::user()->id;

        return parent::create($data);
    }

    public static function update(Builder $query, array $data)
    {
        // Pastikan user_id tidak dapat diubah oleh pengguna
        if (isset($data['user_id'])) {
            unset($data['user_id']);
        }

        return parent::update($query, $data);
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
                Tables\Columns\TextColumn::make('tgl_pengajuan')
                    ->label('Tgl Pengajuan')
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
                Tables\Columns\TextColumn::make('ruangs.masterruangs.nama')
                    ->label('Jenis Ruangan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_usulan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'process' => 'warning',
                        'success' => 'success',
                        'danger' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Pending',
                        'process' => 'Proses',
                        'success' => 'Diterima',
                        'danger' => 'Ditolak',
                        default => 'Unknown',
                    }),

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
                Tables\Actions\ViewAction::make(),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.name')
                    ->label('Pengguna')
                    ->default('Pengguna tidak ditemukan'),

                TextEntry::make('bangunans.nama_bangunan')
                    ->label('Bangunan'),

                TextEntry::make('ruangs.nama_ruang')
                    ->label('Ruang'),

                TextEntry::make('jenis_usulan')
                    ->label('Jenis Usulan')
                    ->colors([
                        'Ringan' => 'success',
                        'Sedang' => 'warning',
                        'Berat' => 'danger',
                    ]),

                // FileEntry::make('surat')
                //     ->label('Surat Usulan')
                //     ->url(fn ($record) => $record->surat ? Storage::url($record->surat) : null),

                // Menampilkan gambar denah
                ImageEntry::make('denah')
                    ->label('Denah')
                    ->url(fn ($record) => $record->denah ? Storage::url($record->denah) : null)
                    ->height('250px') // Sesuaikan ukuran gambar
                    ->width('auto'),

                ImageEntry::make('kondisi_ruangan')
                    ->label('Kondisi Ruangan')
                    ->url(fn ($record) => $record->denah ? Storage::url($record->denah) : null)
                    ->height('250px') // Sesuaikan ukuran gambar
                    ->width('auto'),

                TextEntry::make('ket')
                    ->label('Keterangan'),
                PdfViewerEntry::make('file')
                    ->label('Surat Usulan')
                    ->minHeight('40svh')
                    ->fileUrl(fn ($record) => $record && $record->surat ? 'kerudung/'.Storage::url($record->surat) : '') // Set the file url if you are getting a pdf without database
                    ->columnSpanFull()

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
            'index' => Pages\ListUsulanrehabs::route('/'),
            'create' => Pages\CreateUsulanrehab::route('/create'),
            'edit' => Pages\EditUsulanrehab::route('/{record}/edit'),
        ];
    }
}
