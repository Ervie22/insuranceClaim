<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layer;

class LayerController extends Controller
{
    //
    // Store a new map layer
    public function index()
    {
        return view('map');
    }

    public function store(Request $request)
    {
        $layer = new Layer();
        $layer->study_id = $request->study_id;
        $layer->name = $request->name;
        $layer->geojson = $request->geojson;
        $layer->save();

        return response()->json(['success' => true]);
    }

    public function load(Request $request)
    {
        $studyId = $request->query('study_id');

        $layers = Layer::where('study_id', $studyId)->get();
        return response()->json($layers);
    }
}
