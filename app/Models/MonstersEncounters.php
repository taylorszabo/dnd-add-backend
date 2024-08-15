<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonstersEncounters extends Model
{

    protected $guarded = [];

    public function monster(): BelongsTo
    {
        return $this->belongsTo(Monsters::class);
    }

    public function encounter(): BelongsTo
    {
        return $this->belongsTo(Encounters::class);
    }
}

