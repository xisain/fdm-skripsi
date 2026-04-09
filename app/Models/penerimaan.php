<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'tanggal_explorasi', 'jenis_form', 'tanggal_penerimaan', 'tempat_asal', 'country', 'source', 'native'])]
class penerimaan extends Model
{
    public function timPenerimaans(): HasMany
    {
        return $this->hasMany(tim_penerimaan::class);
    }

    public function tanamanPenerimaans(): HasMany
    {
        return $this->hasMany(tanaman_penerimaan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function legal_documents() : HasMany {
        return $this->hasMany(legal_documents::class);
    }
}
