<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Version;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Generation extends Model
{
    use HasFactory;
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
    public function version()
    {
        return $this->belongsTo(Version::class);
    }
}
