<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Mark;
use App\Models\Version;
use App\Models\Generation;
use App\Models\Item;
use App\Models\Post;
use App\Http\Requests\Catalog\FilterRequest;

class CatalogController extends Controller
{
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $mark_id = $data['mark_id'] ?? null;
        $version_id = $data['version_id'] ?? null;
        $generation_id = $data['generation_id'] ?? null;

        $results = DB::table('items')
            ->join('generations', 'items.generation_id', '=', 'generations.id')
            ->join('versions', 'generations.version_id', '=', 'versions.id')
            ->join('marks', 'versions.mark_id', '=', 'marks.id')
            ->select('marks.id as mark_id', 'versions.id as version_id', 'generations.id as generation_id', 'items.name', 'items.image', 'items.id', 'items.cost')
            ->when($mark_id, function ($query, $mark_id) {
                return $query->where('marks.id', '=', $mark_id);
            })
            ->when($version_id, function ($query, $version_id) {
                return $query->where('versions.id', '=', $version_id);
            })
            ->when($generation_id, function ($query, $generation_id) {
                return $query->where('generations.id', '=', $generation_id);
            })
            ->paginate(12)
            ->onEachSide(1);
        /*$query = Item::query();
        if (isset($data['text'])) dd($data['text']);
        if (isset($data['mark_id'])) {
            $query->where('mark_id', $data['mark_id']);
            $m = $data['mark_id'];
            $searchUrl = "&mark_id=$m";
            if (isset($data['version_id'])) {
                $query->where('version_id', $data['version_id']);
                $p = $data['version_id'];
                $searchUrl = $searchUrl . "&version_id=$p";
                if (isset($data['generation_id'])) {
                    $query->where('generation_id', $data['generation_id']);
                    $g = $data['generation_id'];
                    $searchUrl = $searchUrl . "&generation_id=$g";
                }
            }   
        };*/
        //dd($query->paginate(12));
        //$admin = true;
        //if (!Auth::check() || auth()->user()->role !== 'admin') {
        //  $admin = false;
        //}
        $searchUrl ='&' . http_build_query($data);
        $totalPages = $results->lastPage();
        return Inertia::render('Catalog/Index', [
            'marks' => Mark::all(),
            'versions' => Version::all(),
            'generations' => Generation::all(),
            'latest' => Post::latest()->take(3)->get(),
            'items' => $results,
            'searchUrl' => $searchUrl,
            'thisItems' => $results->count(),
            'totalPages' => $totalPages,
        ]);
    }

    public function show(Item $item)
    {
        $marks = Mark::all();
        $versions = Version::all();
        $generations = Generation::all();
        return inertia('Catalog/Show', compact('item', 'marks', 'versions', 'generations'));
    }
}
