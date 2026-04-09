<?php

namespace App\Services\penerimaan;

use App\Models\tanaman_penerimaan;
use Illuminate\Support\Facades\DB;

class nomorAksesService
{
    public function generateBatch(string $kodeKebun, int $total): array
    {
        return DB::transaction(function () use ($kodeKebun, $total) {

            $tahun = now()->format('Y');
            $bulan = now()->format('m');
            $prefix = "{$kodeKebun}{$tahun}{$bulan}";

            $last = tanaman_penerimaan::where('nomor_akses', 'like', "{$prefix}%")
                ->lockForUpdate()
                ->orderByDesc('nomor_akses')
                ->value('nomor_akses');

            $lastNumber = $last ? (int) substr($last, -4) : 0;

            $numbers = [];

            for ($i = 1; $i <= $total; $i++) {
                $numbers[] = $prefix.str_pad($lastNumber + $i, 4, '0', STR_PAD_LEFT);
            }

            return $numbers;
        });
    }
}
