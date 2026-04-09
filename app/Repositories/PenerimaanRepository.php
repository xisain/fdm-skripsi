<?php

namespace App\Repositories;

use App\Models\penerimaan;
use App\Models\tanaman_penerimaan;

class PenerimaanRepository
{
    public function getPaginatedWithRelations($perPage = 5)
    {
        return penerimaan::with([
            'tanamanPenerimaans',
            'timPenerimaans.user',
            'user',
        ])
            ->orderBy('tanggal_penerimaan', 'asc')
            ->paginate($perPage);
    }

    public function countAll()
    {
        return penerimaan::count();
    }

    public function countTanaman()
    {
        return tanaman_penerimaan::count();
    }

    public function countByJenis($jenis)
    {
        return penerimaan::where('jenis_form', $jenis)->count();
    }
}
