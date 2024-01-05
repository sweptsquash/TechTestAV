<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Inertia\Middleware;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    public function handle(Request $request, Closure $next): Response
    {
        Vite::useIntegrityKey('integrity');

        return parent::handle($request, $next);
    }

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return Vite::manifestHash();
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        // Forced User Token Creation for technical test purposes only!
        $user = User::find(1);

        $token = $user->createToken('appToken');

        return array_merge(parent::share($request), [
            'token' => $token->plainTextToken,
        ]);
    }
}
