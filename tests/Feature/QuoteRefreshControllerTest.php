<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class QuoteRefreshControllerTest extends TestCase
{
    protected User $user;

    protected string $apiToken;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->apiToken = $this->user->createToken('appToken')->plainTextToken;
    }

    public function testReturnUnauthorizedRequest()
    {
        $this->getJson(route('quotes.refresh'))
            ->assertUnauthorized();
    }

    public function testRefreshQuotes()
    {
        Http::fake([
            'https://api.kanye.rest/' => Http::sequence()
                ->push(['quote' => 'Perhaps I should have been more like water today'])
                ->push(['quote' => 'We\'ve gotten comfortable with not having what we deserve'])
                ->push(['quote' => 'Only free thinkers'])
                ->push(['quote' => 'There\'s so many lonely emojis man'])
                ->push(['quote' => 'I\'ve known my mom since I was zero years old. She is quite dope.']),
        ]);

        $this->getJson(route('quotes.refresh'), ['Authorization' => "Bearer {$this->apiToken}"])
            ->assertSuccessful()
            ->assertJsonCount(5, 'data');
    }
}
