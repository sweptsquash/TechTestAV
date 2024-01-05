<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Tests\TestCase;

class QuoteControllerTest extends TestCase
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
        $this->getJson(route('quotes.index'))
            ->assertUnauthorized();
    }

    public function testFetchfiveRandomQuotes()
    {
        collect([
            'Perhaps I should have been more like water today',
            'We\'ve gotten comfortable with not having what we deserve',
            'Only free thinkers',
            'There\'s so many lonely emojis man',
            'I\'ve known my mom since I was zero years old. She is quite dope.',
        ])
            ->each(fn ($quote) => Quote::create(['quote' => $quote]));

        $this->getJson(route('quotes.index'), ['Authorization' => "Bearer {$this->apiToken}"])
            ->assertSuccessful()
            ->assertJsonCount(5, 'data');
    }
}
