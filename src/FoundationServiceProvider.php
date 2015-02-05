<?php

namespace Foundation;

use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider {

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
}