<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenStreetMapService;

class AddressController extends Controller
{
    // app/Http/Controllers/AddressController.php
    public function autocomplete(Request $request)
    {
        // dd($request->all());
        $query = $request->get('query');

        if (strlen($query) < 3) {
            return response()->json([]);
        }

        $osmService = new OpenStreetMapService();
        $results = $osmService->autocomplete($query);

        $formatted = array_map(function ($item) {
            return [
                'display_name' => $item['display_name'],
                'street' => $item['address']['road'] ?? '',
                'house_number' => $item['address']['house_number'] ?? '',
                'city' => $item['address']['city'] ?? $item['address']['town'] ?? $item['address']['village'] ?? '',
                'state' => $item['address']['state'] ?? '',
                'postcode' => $item['address']['postcode'] ?? '',
                'lat' => $item['lat'],
                'lon' => $item['lon']
            ];
        }, $results);
        dd($results);
        return response()->json($formatted);
    }
}
