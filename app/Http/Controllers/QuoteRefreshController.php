<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class QuoteRefreshController extends Controller
{
    public function __invoke()
    {
        $quotes = collect(Http::retry(3, 100)->pool(fn (Pool $pool) => [
            $pool->get('https://api.kanye.rest/'),
            $pool->get('https://api.kanye.rest/'),
            $pool->get('https://api.kanye.rest/'),
            $pool->get('https://api.kanye.rest/'),
            $pool->get('https://api.kanye.rest/'),
        ]))->map(function (Response $response) {
            return Quote::firstOrCreate(['quote' => $response->json('quote')]);
        });

        return QuoteResource::collection($quotes);
    }
}
