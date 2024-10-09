<?php

namespace App\Exports;

use App\Models\Usulanrehab;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanUsulanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $index = 0;
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function collection()
    {
        $user = Auth::user();

        // Build the query
        $query = Usulanrehab::join('ruangs', 'usulanrehabs.ruangs_id', '=', 'ruangs.id')
        ->join('masterruangs', 'ruangs.masterruangs_id', '=', 'masterruangs.id')
        ->select('usulanrehabs.*', 'ruangs.nama_ruang', 'masterruangs.nama as master_nama_ruang');

        // Check user role and filter accordingly
        // if ($user->hasRole('super_admin')) {
        //     return $query->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6])->get();
        // } else {
          return
            $query->where('usulanrehabs.user_id', $this->user_id)->get();
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
            $model->user->name,
            $model->user->kecamatan,
            $model->bangunans->nama_bangunan,
            $model->nama_ruang,
            $model->master_nama_ruang,
            $model->jenis_usulan,
            $model->ket,
            $model->status,
        ];
    }
}
