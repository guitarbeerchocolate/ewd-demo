<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class ApiController extends Controller
{
    /*
    public function fetchApiData()
    {
        $response = Http::get('https://effectivewebdesigns.blogspot.com/feeds/posts/default?alt=json');
        $data = $response->json();

        if (isset($data['feed']['entry'])) {
            $entries = $data['feed']['entry'];
        } else {
            $entries = [];
        }

        return view('welcome', ['entries' => $entries]);
    }
    */
}
