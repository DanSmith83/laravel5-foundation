<?php

namespace Foundation;

use Foundation\Form\FoundationFiveFormBuilder;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Support\ViewErrorBag;

class FoundationServiceProvider extends HtmlServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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