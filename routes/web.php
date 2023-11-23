<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search-results', function () {
    $query = request('query');

    // Perform the API request with the search query
    $response = Http::get('https://effectivewebdesigns.blogspot.com/feeds/posts/default?alt=json&q=' . urlencode($query));
    $data = $response->json();

    // Extract the relevant data from the API response
    if (isset($data['feed']['entry'])) {
        $entries = $data['feed']['entry'];
    } else {
        $entries = [];
    }

    return view('welcome', ['entries' => $entries, 'query' => $query]);
})->name('search-results');
