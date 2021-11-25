<?php

namespace Apility\ItsLearning\Providers;

use Illuminate\Support\ServiceProvider;

use Apility\ItsLearning\Contracts\AuthorizesClients;

use Apility\ItsLearning\Services\Authentication;
use Apility\ItsLearning\Services\PersonManagement;

class ItsLearningServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorizesClients::class, fn () => new Authentication(
            $this->app['config']->get('itslearning.username'),
            $this->app['config']->get('itslearning.password'),
            $this->app['config']->get('itslearning.sandbox')
        ));

        $this->app->bind(PersonManagement::class, PersonManagement::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/itslearning.php' => config_path('itslearning.php'),
        ]);
    }
}
