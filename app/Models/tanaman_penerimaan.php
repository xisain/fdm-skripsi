<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['penerimaan_id', 'scientific_name', 'nomor_akses', 'nama_lokal', 'marga', 'marga_jenis', 'suku', 'spesies', 'author_name', 'locality', 'jumlah_material', 'vak_no','collector_id'])]
class tanaman_penerimaan extends Model
{
    public function penerimaan(): BelongsTo
    {
        return $this->belongsTo(penerimaan::class);
    }

}
