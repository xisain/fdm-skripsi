<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['penerimaan_id', 'user_id', 'role'])]
class tim_penerimaan extends Model
{
    public function penerimaan(): BelongsTo
    {
        return $this->belongsTo(penerimaan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
