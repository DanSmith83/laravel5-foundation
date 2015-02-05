<?php

namespace Foundation;

use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider extends ServiceProvider {

    public function boot()
    {

    }

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->app->bind(
            'foundation.presenter',
            'Foundation\Pagination\FoundationPresenter'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Foundation\Pagination\FoundationPresenter'];
    }
}