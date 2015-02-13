<?php

namespace Foundation;

use Foundation\Form\FoundationFiveFormBuilder;
use Illuminate\Html\HtmlServiceProvider;
use Illuminate\Support\ViewErrorBag;

class FoundationFormServiceProvider extends HtmlServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->bindShared('form', function($app)
        {
            $form = new FoundationFiveFormBuilder(
                $app['html'],
                $app['url'],
                $app['session.store']->getToken(),
                $app['session.store']->get('errors') ?: new ViewErrorBag
            );

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
        return ['html', 'form'];
    }
}