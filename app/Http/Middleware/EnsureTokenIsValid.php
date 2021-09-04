<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $account = DB::table('accounts')->get()->where('account_number', $request->route('account'))->first();

        if (auth()->user()->id === $account->user_id) {
            return $next($request);
        }
        
        return response()->json([
            'message' => 'You do not own this account! >:v'
        ], 403);
    }
}
