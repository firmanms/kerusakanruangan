<?php

namespace App\Filament\Resources\TanahResource\Pages;

use App\Filament\Resources\TanahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditTanah extends EditRecord
{
    protected static string $resource = TanahResource::class;

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

        // Mendapatkan tanah yang sedang di-edit
        $tanah = $this->record;

        // Periksa apakah user yang sedang login memiliki hak akses untuk mengedit tanah
        if ($tanah->user_id !== $userId and $roleNames !== 'super_admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
