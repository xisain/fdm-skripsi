<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[Fillable('document_name','document_path','penerimaan_id','user_id')]

class legal_documents extends Model
{
    public function penerimaan() : BelongsTo {
        return $this->belongsTo(penerimaan::class);
    }
        public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
