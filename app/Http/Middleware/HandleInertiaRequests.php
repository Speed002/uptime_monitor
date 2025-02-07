<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Illuminate\Http\Request;
use App\Enums\EndpointFrequency;
use App\Http\Resources\SiteResource;
use App\Http\Resources\EndpointFrequencyResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'endpointFrequencies' => EndpointFrequencyResource::collection(EndpointFrequency::cases()),
            'sites' => $request->user() ? SiteResource::collection($request->user()->sites()->latest()->get()) : null, //here we are only returning the sites and endpoints of the current user
        ];
    }
}
