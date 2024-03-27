<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Generation;
use App\Models\Mark;
use App\Models\Version;
class Item extends Model
{
    use HasFactory;
public function generation()
    {
        return $this->belongsTo(Generation::class);
    }
}
