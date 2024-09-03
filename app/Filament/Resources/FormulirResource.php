<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormulirResource\Pages;
use App\Filament\Resources\FormulirResource\RelationManagers;
use App\Models\Bangunan;
use App\Models\Formulir;
use App\Models\Ruang;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Fieldset as ComponentsFieldset;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class FormulirResource extends Resource
{
    protected static ?string $model = Formulir::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Formulir';

    protected static ?string $navigationLabel = 'Isi Formulir';

    protected static ?string $modelLabel = 'Isi Formulir';

    protected static ?string $pluralLabel = 'Isi Formulir';

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
                            ]),
                        Tabs\Tab::make('Struktur')
                            ->schema([
                                Fieldset::make('Pondasi')
                                    // ->description('-')
                                    ->schema([
                                        Forms\Components\Select::make('pondasi_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\Select::make('pondasi_tahap2')
                                            ->label('Tahap 2 Hitung Volume Kerusakan')
                                            ->required()
                                            ->options([
                                                '0' => 'Pondasi diindikasi dalam kondisi baik',
                                                '20' => 'Penurunan merata pada seluruh struktur bangunan',
                                                '35' => 'Penurunan tidak merata, namun perbedaan penurunan tidak melebihi 1/250 L',
                                                '50' => 'Penurunan > 1/250 L sehingga menimbulkan kerusakan struktur atasnya. Tanah disekeliling bangunan naik',
                                                '70' => 'Bangunan miring secara kasat mata, Lantai dasar naik/menggelembung',
                                                '85' => 'Pondasi patah, bergeser akibat longsor, struktur atas menjadi rusak ',
                                                '100' => 'Material, dimensi, dan konstruksi pondasi diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)',
                                            ]),
                                    ]),
                                Fieldset::make('Kolom')
                                    // ->description('-')
                                    ->schema([
                                        Forms\Components\TextInput::make('kolom_volume')
                                            ->label('Volume Seluruh Komponen (unit)')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\Select::make('kolom_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\TextInput::make('kolom_tahap2a')
                                            ->label('Tdk Rusak')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2b')
                                            ->label('Sangat Ringan')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2c')
                                            ->label('Ringan')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2d')
                                            ->label('Sedang')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2e')
                                            ->label('Berat')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2f')
                                            ->label('Sangat Berat')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kolom_tahap2g')
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->required()
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Balok')
                                    ->schema([
                                        Forms\Components\TextInput::make('balok_volume')
                                            ->label('Volume Seluruh Komponen (unit)')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\Select::make('balok_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\TextInput::make('balok_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('balok_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Atap')
                                    ->schema([
                                        Forms\Components\TextInput::make('atap_volume')
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->required()
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\Select::make('atap_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\TextInput::make('atap_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('atap_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),

                            ]),
                        Tabs\Tab::make('Arsitektur')
                            ->schema([
                                Fieldset::make('Dinding/Partisi')
                                    ->schema([
                                        Forms\Components\TextInput::make('dinding_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\Select::make('dinding_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\TextInput::make('dinding_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('dinding_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Plafond')
                                    ->schema([
                                        Forms\Components\TextInput::make('plafond_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\Select::make('plafond_tahap1')
                                            ->label('Tahap 1 Pengamatan Visual')
                                            ->required()
                                            ->options([
                                                '0' => 'Tidak ada kerusakan',
                                                '1' => 'Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan',
                                                '3' => 'Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan',
                                            ]),
                                        Forms\Components\TextInput::make('plafond_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('plafond_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Lantai')
                                    ->schema([
                                        Forms\Components\TextInput::make('lantai_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('lantai_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Kusen')
                                    ->schema([
                                        Forms\Components\TextInput::make('kusen_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (unit)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('kusen_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Pintu')
                                    ->schema([
                                        Forms\Components\TextInput::make('pintu_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (unit)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('pintu_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Jendela')
                                    ->schema([
                                        Forms\Components\TextInput::make('jendela_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (unit)')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('jendela_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(4),
                                Fieldset::make('Finishing Plafond')
                                    ->schema([
                                        Forms\Components\TextInput::make('finishing_plafont_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_plafont_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Finishing Dinding')
                                    ->schema([
                                        Forms\Components\TextInput::make('finishing_dinding_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_dinding_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                                Fieldset::make('Finishing Kusen & Pintu')
                                    ->schema([
                                        Forms\Components\TextInput::make('finishing_kusen_volume')
                                            ->required()
                                            ->label('Volume Seluruh Komponen (%)')
                                            ->default(100)
                                            ->readOnly()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2a')
                                            ->required()
                                            ->label('Tdk Rusak')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2b')
                                            ->required()
                                            ->label('Sangat Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2c')
                                            ->required()
                                            ->label('Ringan')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2d')
                                            ->required()
                                            ->label('Sedang')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2e')
                                            ->required()
                                            ->label('Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2f')
                                            ->required()
                                            ->label('Sangat Berat')
                                            ->numeric(),
                                        Forms\Components\TextInput::make('finishing_kusen_tahap2g')
                                            ->required()
                                            ->label('Komponen Tdk Sesuai/Tdk Ada')
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Utilitas')
                            ->schema([
                                Fieldset::make('Instalasi Listrik')
                                    ->schema([
                                        Forms\Components\Select::make('instalasi_listrik_tahap2')
                                            ->label('Tahap 2 Hitung Volume Kerusakan')
                                            ->required()
                                            ->options([
                                                '0' => 'Jaringan listrik dalam kondisi baik',
                                                '20' => 'Sebagian kecil komponen dari panel-panel LP rusak, ada sedikit jalur kabel instalasi shortage, sebagian kecil armature rusak ringan, sehingga biaya perbaikan kurang dari 10% dari biaya instalasi baru',
                                                '35' => 'Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak ringan, sehingga biaya perbaikan 10-25% dari biaya instalasi baru',
                                                '50' => 'Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak berat dan ringan, sehingga biaya perbaikan 25-50% dari biaya instalasi baru',
                                                '70' => 'Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, sebagian besar armature rusak, sehingga biaya perbaikan 50-65 % dari instalasi baru',
                                                '85' => 'Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, seluruh armature rusak berat, sehingga biaya perbaikan lebih dari 65 % dari instalasi baru ',
                                                '100' => 'Material, dimensi, dan konstruksi jaringan listrik diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)',
                                            ])->columnSpanFull(),
                                    ]),
                                Fieldset::make('Instalasi Air Bersih')
                                    ->schema([
                                        Forms\Components\Select::make('instalasi_airbersih_tahap2')
                                            ->label('Tahap 2 Hitung Volume Kerusakan')
                                            ->required()
                                            ->options([
                                                '0' => 'Sistem penyediaan air dalam kondisi baik',
                                                '20' => 'Kebocoran pipa terbatas ditempat yang terlihat atau mudah dicapai, keran-keran kecil rusak, sehingga biaya perbaikan kurang dari 10% biaya instalasi baru',
                                                '35' => 'Bagian-bagian kecil pemipaan bocor, motor pompa terbakar, keran-keran kecil rusak, sehingga biaya perbaikan antara 10-25% dari biaya instalasi baru',
                                                '50' => 'Pompa, motor, pipa, dan keran rusak apabila diganti atau diperbaiki memerlukan biaya antara 25-50% dari biaya instalasi baru',
                                                '70' => 'Sebagian besar pompa, sebagian besar motor terbakar, pipa utama bocor namun ditempat terbuka, beberapa keran tidak berfungsi, sehingga biaya perbaikan 50-65% dari biaya instalasi baru',
                                                '85' => 'Pompa –pompa rusak total, motor terbakar, di banyak tempat terbuka dan tutup pipa-pipa bocor keran-keran tidak berfungsi, sehingga perbaikan instalasi perlu menyeluruh, dengan perkiraan biaya lebih dari 65% dari biaya instalasi baru',
                                                '100' => 'Material, dimensi, dan konstruksi sistem penyediaan air diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)',
                                            ])->columnSpanFull(),
                                    ]),
                                Fieldset::make('Drainase Limbah')
                                    ->schema([
                                        Forms\Components\TextInput::make('drainaselimbah_volume')
                                            ->label('Drainase Limbah (m)')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2a')
                                            ->label('Tdk Rusak')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2b')
                                            ->label('Sangat Ringan')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2c')
                                            ->label('Ringan')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2d')
                                            ->label('Sedang')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2e')
                                            ->label('Berat')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2f')
                                            ->label('Sangat Berat')
                                            ->required()
                                            ->numeric(),
                                        Forms\Components\TextInput::make('drainaselimbah_tahap2g')
                                            ->label('Komponen Tdk Sesuai/ Tdk Ada')
                                            ->required()
                                            ->numeric(),
                                    ])
                                    ->columns(2),
                            ]),
                    ])->columnSpanFull(),
                     // Make the tabs full width

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
                // Tables\Columns\TextColumn::make('pondasi_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pondasi_tahap2')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kolom_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('balok_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('atap_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('dinding_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap1')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('plafond_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('lantai_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('kusen_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('pintu_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('jendela_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_plafont_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_dinding_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('finishing_kusen_tahap2g')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('instalasi_listrik_tahap2')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('instalasi_airbersih_tahap2')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_volume')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2a')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2b')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2c')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2d')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2e')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2f')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('drainaselimbah_tahap2g')
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
                Action::make('custom_button')
                ->label('Formulir')
                ->icon('heroicon-o-document-text')
                ->url(fn ($record) => route('formulirruangan', $record->id)) // Mengarahkan ke route
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
            'index' => Pages\ListFormulirs::route('/'),
            'create' => Pages\CreateFormulir::route('/create'),
            'edit' => Pages\EditFormulir::route('/{record}/edit'),
        ];
    }
}
