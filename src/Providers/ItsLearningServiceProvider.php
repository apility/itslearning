<?php

namespace Apility\ItsLearning\Providers;

use Illuminate\Support\ServiceProvider;

use Apility\ItsLearning\Contracts\AuthorizesClients;

use Apility\ItsLearning\Services\Authentication;

use Apility\ItsLearning\Services\PersonManagementServiceSync;
use Apility\ItsLearning\Services\MembershipManagementServiceSync;
use Apility\ItsLearning\Services\GroupManagementServiceSync;

class ItsLearningServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(AuthorizesClients::class, fn () => new Authentication(
            $this->app['config']->get('itslearning.username'),
            $this->app['config']->get('itslearning.password'),
            $this->app['config']->get('itslearning.sandbox')
        ));

        $this->app->bind(PersonManagementServiceSync::class);
        $this->app->bind(MembershipManagementServiceSync::class);
        $this->app->bind(GroupManagementServiceSync::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/itslearning.php' => config_path('itslearning.php'),
        ]);
    }
}
