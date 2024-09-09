<?php

namespace App\Filament\Resources\UsulanrehabResource\Pages;

use App\Filament\Resources\UsulanrehabResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditUsulanrehab extends EditRecord
{
    protected static string $resource = UsulanrehabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeFill()
    {
        // Asumsikan bahwa pengguna memiliki metode atau properti untuk mendapatkan role
        $roles = Auth::user()->roles->pluck('name'); // Atau metode lain jika berbeda
        $roleNames = $roles->implode(', ');
        // Mendapatkan user ID yang sedang login
        $userId = Auth::id();

        // Mendapatkan usulan yang sedang di-edit
        $usulan = $this->record;

        // Periksa apakah user yang sedang login memiliki hak akses untuk mengedit usulan
        if ($usulan->user_id !== $userId and $roleNames !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
