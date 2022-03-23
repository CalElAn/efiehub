<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return 
            array_merge(
                parent::share($request), [
                    'flash' => [
                        'message' => fn () => $request->session()->get('message')
                    ],
                    'csrf_token' => csrf_token(),
                    'efiehubInfoAccount' => User::where('email', 'info@efiehub.com')->first(),
                    'isUserAuthenticated' => Auth::check(),
                    'authenticatedUser' => Auth::user()?->makeVisible(['email', 'phone_number']),
                    'propertyTypes' => PropertyType::all(),
                    'regions' =>  DB::table('regions')->orderBy('name', 'asc')->get(),
                    'minPrice' => DB::table('properties')->min('price'),
                    'maxPrice' => DB::table('properties')->max('price'),
                ]
            );
    }
}
