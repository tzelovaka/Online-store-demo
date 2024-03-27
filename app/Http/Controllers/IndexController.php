<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Generation;
use App\Models\Version;
use App\Models\Mark;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\MarkResource;
use App\Http\Resources\VersionResource;
use App\Http\Resources\GenerationResource;
use App\Http\Resources\ItemResource;
class IndexController extends Controller
{
    public function index()
    {
        $marks = MarkResource::collection(Mark::all());
        $versions = VersionResource::collection(Version::all());
        $generations = GenerationResource::collection(Generation::all());
        $items = ItemResource::collection(Item::all());
        return Inertia::render('Welcome', [
            'items' => $items,
            'marks' => $marks,
            'versions' => $versions,
            'generations' => $generations,
        ]);
    }
}
