<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Services\PersonManagementServiceSync;
use Apility\ItsLearning\Models\Person;

/**
 * @method static Person|null readPerson(\Netflex\Customers\Customer $customer)
 * @method static Person|null createPerson(\Netflex\Customers\Customer $customer, string $role = 'student')
 */
class PersonManagement extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PersonManagementServiceSync::class;
    }
}
