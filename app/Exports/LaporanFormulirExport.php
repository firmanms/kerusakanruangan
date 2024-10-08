<?php

namespace App\Exports;

use App\Models\Formulir;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanFormulirExport implements FromCollection, WithHeadings, WithMapping
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
        $query = Formulir::with('ruangs.masterruangs')
            ->join('ruangs', 'formulirs.ruangs_id', '=', 'ruangs.id')
            ->join('masterruangs', 'ruangs.masterruangs_id', '=', 'masterruangs.id')
            ->selectRaw('ruangs.masterruangs_id,
                masterruangs.nama AS masterruang_nama,
                SUM(CASE WHEN nilai_akhir IS NULL THEN 1 ELSE 0 END) as rusak_tidak_isi,
                SUM(CASE WHEN nilai_akhir <= 30 THEN 1 ELSE 0 END) as rusak_ringan,
                SUM(CASE WHEN nilai_akhir > 30 AND nilai_akhir <= 45 THEN 1 ELSE 0 END) as rusak_sedang,
                SUM(CASE WHEN nilai_akhir > 45 THEN 1 ELSE 0 END) as rusak_berat')
            ->groupBy('ruangs.masterruangs_id', 'masterruangs.nama')
            ->orderBy('masterruangs.id');

        // Check user role and filter accordingly
        // if ($user->hasRole('super_admin')) {
        //     return $query->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6])->get();
        // } else {
          return
            $query->where('formulirs.user_id', $this->user_id)
                ->whereIn('ruangs.masterruangs_id', [1, 2, 3, 4, 5, 6])->get();
        // }
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenis Ruangan',
            'Rusak Tidak Isi',
            'Rusak Ringan',
            'Rusak Sedang',
            'Rusak Berat',
        ];
    }

    public function map($model): array
    {
        $this->index++;

        return [
            $this->index,
            $model->masterruang_nama ?? 'N/A',
            $model->rusak_tidak_isi,
            $model->rusak_ringan,
            $model->rusak_sedang,
            $model->rusak_berat,
        ];
    }
}
