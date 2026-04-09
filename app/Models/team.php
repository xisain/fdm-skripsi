<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('team_name', 'description', 'explore_location')]
class team extends Model
{
    public function team_member()
    {
        return $this->hasMany(team_member::class, 'team_id');
    }
}
