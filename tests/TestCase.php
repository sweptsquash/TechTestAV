<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function login(?User $user = null, array $extra = []): User
    {
        $user = $user ?? $this->createUser($extra);

        $this->actingAs($user);

        return $user;
    }

    protected function createUser(array $extra = []): User
    {
        return User::factory()->create($extra);
    }
}
