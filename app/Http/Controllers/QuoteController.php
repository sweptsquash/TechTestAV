<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function __invoke()
    {
        return QuoteResource::collection(
            Quote::inRandomOrder()->limit(5)->get()
        );
    }
}
