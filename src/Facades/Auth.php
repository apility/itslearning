<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Contracts\AuthorizesClients;

/**
 * @method static \SoapClient authorize(\SoapClient $client)
 * @method static bool sandboxed()
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AuthorizesClients::class;
    }
}
