<?php

namespace App\Http\Middleware\Backend;

use Closure;
use Illuminate\Http\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current_route = \Route::currentRouteName();
        if (!\Auth::guard('user')->user()->isPerm($current_route)) {
            view()->share('breadcrumbs', [
                ['name' => '403', 'link' => '']
            ]);

            return new Response(view('backend.common.perm'), 403);
        }
        return $next($request);
    }
}
