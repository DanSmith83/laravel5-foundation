<?php

namespace Foundation;

use Foundation\Form\FoundationFiveFormBuilder;
use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function register()
    {
        $this->registerFormBuilder();

        $this->app->bind('foundation', '\Foundation\Factory');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {
            $form = new FoundationFiveFormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
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