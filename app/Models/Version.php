<?php

namespace App\Models;

use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Generation;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Version extends Model
{
    use HasFactory;
    public function generation()
    {
        return $this->hasMany(Generation::class);
    }

    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }
  
}
