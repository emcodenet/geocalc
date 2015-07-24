<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 7/24/15
 * Time: 12:14 PM
 */

namespace Emcodenet\Geocalc;


use Exception;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider {
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Register the service provider.
     *
     * @throws \Exception
     * @return void
     */
    public function register()
    {
    }
    public function boot()
    {
        $this->app->bind('geocalc', function ($app) {
            return new Geocalc();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('sabre-laravel-bridge');
    }
    /**
     * Define a value, if not already defined
     *
     * @param string $name
     * @param string $value
     */
    protected function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }
}