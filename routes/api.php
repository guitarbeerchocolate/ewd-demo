<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/suggestions', function () {
    $query = request('query');

    // Perform the API request with the search query
    $response = Http::get('https://effectivewebdesigns.blogspot.com/feeds/posts/default?alt=json&q=' . urlencode($query));
    $data = $response->json();

    // Extract blog titles as suggestions
    $suggestions = [];

    if (isset($data['feed']['entry'])) {
        foreach ($data['feed']['entry'] as $entry) {
            $title = $entry['title']['$t'];
            $suggestions[] = ['title' => $title];
        }
    }

    return ['suggestions' => $suggestions];
});

Route::get('/brave-results', function () {
    $query = request('query');

    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'Accept-Encoding' => 'gzip',
        'X-Subscription-Token' => env('BRAVE_API_KEY'),
    ])->get("https://api.search.brave.com/res/v1/web/search?q=$query");

    return $response->json();
});
