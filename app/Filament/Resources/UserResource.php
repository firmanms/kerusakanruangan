<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Auth;
use STS\FilamentImpersonate\Tables\Actions\Impersonate;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function getNavigationLabel(): string
    {
        return trans('filament-users::user.resource.label');
    }

    public static function getPluralLabel(): string
    {
        return trans('filament-users::user.resource.label');
    }

    public static function getLabel(): string
    {
        return trans('filament-users::user.resource.single');
    }

    public static function getNavigationGroup(): ?string
    {
        return config('filament-users.group');
    }

    public function getTitle(): string
    {
        return trans('filament-users::user.resource.title.resource');
    }

    public static function form(Form $form): Form
    {
        $rows = [
            TextInput::make('name')
                ->required()
                ->label(trans('filament-users::user.resource.name')),
            TextInput::make('email')
                ->email()
                ->required()
                ->label(trans('filament-users::user.resource.email')),
            TextInput::make('npsn')
                ->required()
                ->label('NPSN'),
            Textarea::make('alamat_sekolah')
                ->required()
                ->label('Alamat Sekolah'),
            TextInput::make('nama_pic')
                ->required()
                ->label('Nama PIC/Operator'),
            TextInput::make('nomor_pic')
                ->required()
                ->label('Nomor WA PIC/Operator'),
            Select::make('jenjang')
                ->required()
                ->options([
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                    'SMK' => 'SMK',
                ])
                ->label('Jenjang'),
            Select::make('status')
                ->required()
                ->options([
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta',
                ])
                ->label('Status'),
            // TextInput::make('password')
            //     ->label(trans('filament-users::user.resource.password'))
            //     ->password()
            //     ->maxLength(255)
            //     ->dehydrateStateUsing(static function ($state) use ($form) {
            //         return !empty($state)
            //                 ? Hash::make($state)
            //                 : User::find($form->getColumns())?->password;
            //     }),
            TextInput::make('password')
                    ->password()
                    ->nullable()
                    ->label('Password (Opsional)'),
        ];


        if (config('filament-users.shield') && class_exists(\BezhanSalleh\FilamentShield\FilamentShield::class)) {
            $rows[] = Forms\Components\Select::make('roles')
                ->multiple()
                ->preload()
                ->relationship('roles', 'name')
                ->label(trans('filament-users::user.resource.roles'));
        }

        $form->schema($rows);

        return $form;
    }

    public static function table(Table $table): Table
    {
        if(class_exists( STS\FilamentImpersonate\Tables\Actions\Impersonate::class) && config('filament-users.impersonate')){
            $table->actions([Impersonate::make('impersonate')]);
        }
        $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->label(trans('filament-users::user.resource.id')),
                TextColumn::make('npsn')
                    ->sortable()
                    ->searchable()
                    ->label('NPSN'),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-users::user.resource.name')),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->label(trans('filament-users::user.resource.email')),
                // IconColumn::make('email_verified_at')
                //     ->boolean()
                //     ->sortable()
                //     ->searchable()
                //     ->label(trans('filament-users::user.resource.email_verified_at')),
                TextColumn::make('created_at')
                    ->label(trans('filament-users::user.resource.created_at'))
                    ->dateTime('M j, Y')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label(trans('filament-users::user.resource.updated_at'))
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('verified')
                    ->label(trans('filament-users::user.resource.verified'))
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('unverified')
                    ->label(trans('filament-users::user.resource.unverified'))
                    ->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
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
        return $table;
    }

    public static function beforeSave(Form $form, $record)
    {
        // Cek apakah field password diisi
        if (!empty($form->password)) {
            $record->password = Hash::make($form->password);
        }

        // Data lain tetap akan disimpan
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
