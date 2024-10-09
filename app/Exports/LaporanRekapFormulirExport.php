<?php

namespace App\Exports;

use App\Models\Formulir;
use App\Models\Usulan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanRekapFormulirExport implements FromCollection
{
    protected $index = 0;

    public function collection()
    {
        $user = Auth::user();
        // Check user role
        if (!$user->hasRole('super_admin')) {
            abort(403, 'Unauthorized action.'); // 403 Forbidden
        }

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
            $query->get();
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
