<?php

namespace MASNathan\LaravelRealIp;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Vectorface\Whip\Whip;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('getRealIp', function ($enabledHeaders = Whip::ALL_METHODS) {
            $whip = new Whip($enabledHeaders);
            $whip->setSource($this->server->all());

            return $whip->getValidIpAddress() ?: $this->ip();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
