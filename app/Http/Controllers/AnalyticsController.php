<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analytics;

use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function store(Request $request)
    {
        Analytics::create([
            'user_id' => Auth::user()->id ?? null,
            'event' => $request->event,
            'details' => $request->details
        ]);
    }
    //
}
