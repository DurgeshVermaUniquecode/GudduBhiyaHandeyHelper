<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.login')->with('error', 'Please login first.');
        }
        return $next($request);
    }
}
