<?php

namespace App\Http\Middleware;

use App\Model\Customers\CustomerGroup;
use Closure;

class Config
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
        if (!session()->has('maintenance') && in_array(\Route::currentRouteName(), ['frontend.maintenance.view', 'frontend.maintenance.open']) === false) {
            return redirect()->route('frontend.maintenance.view');
        }

        $this->configs();
        return $next($request);
    }

    public function configs()
    {
        $configs = \App\Model\Configs\Config::all();
        foreach ($configs as $config) {
            if ($config->serialized == 1) {
                $value = @json_decode($config->value, true);
            } else {
                $value = $config->value;
            }
            config()->set($config->group . '.' . $config->key, $value);
        }
        $this->setCustomerGroupId();
    }

    public function setCustomerGroupId()
    {
        if (auth('customer')->check()) {
            config()->set(CustomerGroup::$config_default_key, auth('customer')->user()->customer_group_id);
        }
    }
}
