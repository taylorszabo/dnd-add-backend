<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Monsters extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function encounters(): BelongsToMany
    {
        return $this->belongsToMany(Encounters::class, 'monsters_encounters');
    }
}
