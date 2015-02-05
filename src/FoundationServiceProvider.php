<?php

namespace Foundation;

use Illuminate\Support\ServiceProvider;

class FoundationServiceProvider {

    public function register()
    {
        $this->app->bind(
            'foundation.presenter',
            'Foundation\Pagination\FoundationPresenter'
        );
    }
}