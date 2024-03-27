<?php

namespace App\Models;

use App\Models\Version;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mark extends Model
{
    use HasFactory;
    public function versions(): HasMany
    {
        return $this->hasMany(Version::class);
    }
}
