<?php

namespace App\Exports;

use App\Models\Usulan;
use App\Models\Usulanrehab;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanRekapUsulanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $index = 0;


    public function collection()
    {
        $user = Auth::user();

        // Build the query
        $query = Usulanrehab::join('ruangs', 'usulanrehabs.ruangs_id', '=', 'ruangs.id')
    ->join('masterruangs', 'ruangs.masterruangs_id', '=', 'masterruangs.id')
    ->join('users', 'usulanrehabs.user_id', '=', 'users.id') // Join users table
    ->join('bangunans', 'usulanrehabs.bangunans_id', '=', 'bangunans.id') // Join bangunans table
    ->select(
        'usulanrehabs.*',
        'ruangs.nama_ruang',
        'masterruangs.nama as master_nama_ruang',
        'users.npsn', // Select columns from users
        'users.name as user_name',
        'bangunans.nama_bangunan' // Select columns from bangunans
    );

        // Check user role and filter accordingly
        // if ($user->hasRole('super_admin')) {
        //     return $query->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6])->get();
        // } else {
          return
            $query->get();
        // }
    }

    public function headings(): array
    {
        return [
            'No',
            'Tgl Pengajuan',
            'NPSN',
            'Nama Sekolah',
            'Kecamatan',
            'Nama Bangunan',
            'Nama Ruang',
            'Jenis Ruang',
            'Jenis Usulan',
            'Ket',
            'Status',
        ];
    }

    public function map($model): array
    {
        $this->index++;

        return [
            $this->index,
            $model->tgl_pengajuan,
            $model->user->npsn ?? 'N/A',
            $model->user_name,
            $model->user->kecamatan,
            $model->nama_bangunan,
            $model->nama_ruang,
            $model->master_nama_ruang,
            $model->jenis_usulan,
            $model->ket,
            $model->status,
        ];
    }
}
