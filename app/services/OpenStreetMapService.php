<?php
// app/Services/IpGeoService.php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class OpenStreetMapService
{
    public function autocomplete($query)
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Your App Name/1.0' // Required by Nominatim
        ])->get('https://nominatim.openstreetmap.org/search', [
            'q' => $query . ', USA',
            'format' => 'json',
            'addressdetails' => 1,
            'limit' => 10,
            'countrycodes' => 'us',
            'dedupe' => 1
        ]);

        return $response->json();
    }
}
