<?php

namespace LukaPeharda\MultiTenancy\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use LukaPeharda\MultiTenancy\Context;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @param \Illuminate\Http\Request
     * @return void
     */
    public function boot(Request $request)
    {
        if (function_exists('config_path')) {
            $this->publishes([
                realpath(__DIR__.'/../../config/multitenancy.php') => config_path('multitenancy.php'),
            ]);
        }

        $this->bootMultitenancy($request);
    }

    /**
     * Boot multitenant context.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function bootMultitenancy(Request $request)
    {
        // Leave if we are running in CLI mode
        if (php_sapi_name() === 'cli') {
            return;
        }

        // Request domain
        $domain = $request->server('SERVER_NAME');

        // Domain base
        $domainBase = $this->app['config']->get('multitenancy.domain');

        if ( ! ends_with($domain, $domainBase)) {
            abort(404, 'Domain mismatch.');
        }

        // Tenant object class name
        $tenantClass = $this->app['config']->get('multitenancy.tenant.class');
        $tenantObject = new $tenantClass;

        $subdomain = str_replace('.' . $domainBase, '', $domain);

        // If there is no subdomain don't look for the context
        if ($subdomain === $domainBase) {
            return;
        }

        $tenant = $tenantObject->where('subdomain', $subdomain)->first();

        // If no website is found abort
        if (null === $tenant) {
            abort(404, 'Tenant not found.');
        }

        // Binding context which holds active website and its settings
        $this->app->singleton('context', function($app) use ($tenant) {
            return new Context($tenant);
        });
    }
}
