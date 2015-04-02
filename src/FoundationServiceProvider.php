<?php

namespace Foundation;

use Collective\Html\HtmlServiceProvider;

class FoundationServiceProvider extends HtmlServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'foundation');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/foundation'),
        ], 'views');
    }

    public function register()
    {
        parent::register();

        $this->app->bind('foundation', 'Foundation\Factory');
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['foundation'];
    }
}