<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('user_id', 'full_name', 'initial_collector_name', 'is_manual', 'last_sequence')]
class Collector extends Model
{
    protected $casts = [
        'is_manual' => 'boolean',
        'last_sequence' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($collector) {
            $collector->initial_collector_name = strtoupper($collector->initial_collector_name);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
