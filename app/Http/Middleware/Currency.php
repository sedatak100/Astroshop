<?php

namespace App\Http\Middleware;

use Closure;

class Currency
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
        $this->currencies();
        return $next($request);
    }

    public function currencies()
    {
        $currencies = \App\Model\Currencies\Currency::all();
        config()->set('currencies', $currencies);
    }
}
