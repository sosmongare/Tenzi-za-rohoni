<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HymnController extends Controller
{
    public function index()
    {
        $visit = Visit::firstOrNew([]);
        $visit->count++;
        $visit->save();
        
        $hymns = $this->getHymnData();

        return view('songs.index', compact('hymns','visit'));
    }

    private function getHymnData()
    {
        $hymnJson = Storage::disk('local')->get('tenzi.json');
        return json_decode($hymnJson, true);
    }
}
