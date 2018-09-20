<?php

namespace App\Http\Middleware\Backend;

use Closure;

class AutoLoaderIsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \View::share('left_menus', \App\Model\Backend\Menu::menus());
        return $next($request);
    }
}
