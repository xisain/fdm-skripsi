<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('user_id', 'team_id', 'role')]
class team_member extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams(): BelongsTo
    {
        return $this->belongsTo(team::class);
    }
}
