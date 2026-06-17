<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => 'Riga,LV',
            'appid' => $apiKey,
            'units' => 'metric',
        ]);

        $weather = $response->json();

        return view('weather.index', compact('weather'));
    }
}