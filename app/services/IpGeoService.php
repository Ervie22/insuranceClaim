<?php
// app/Services/IpGeoService.php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

class IpGeoService
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->client = new Client(['timeout' => 5]);
        $this->token = config('services.ipinfo.token') ?? env('IPINFO_TOKEN');
    }

    public function lookup(string $ip)
    {
        if (empty($ip) || $ip === '127.0.0.1' || $ip === '::1') {
            return null;
        }

        // cache per IP for 24 hours to avoid rate limits
        return Cache::remember("ipgeo:{$ip}", 60 * 24, function () use ($ip) {
            try {
                $url = "https://ipinfo.io/{$ip}/json";
                $query = $this->token ? ['query' => ['token' => $this->token]] : [];
                $res = $this->client->get($url, $query);
                $data = json_decode((string)$res->getBody(), true);

                // ipinfo returns "loc" as "lat,lon"
                if (!empty($data['loc'])) {
                    [$lat, $lon] = explode(',', $data['loc']);
                    $data['latitude'] = $lat;
                    $data['longitude'] = $lon;
                }

                return $data;
            } catch (\Throwable $e) {
                // handle errors gracefully
                return null;
            }
        });
    }
}
