<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$levels)
    {
    	if (in_array($request->user()->level, $levels)) {
    		return $next($request);
    	}

    	if ($request->expectsJson()) {
    		return response()->json([
    			'success' => false,
    			'message' => 'Akses ditolak. Anda tidak memiliki izin.',
    		], 403);
    	}

    	return redirect()->back();
    }
}
