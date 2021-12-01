<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Services\PersonManagementServiceSync;
use Apility\ItsLearning\Models\Person;

/**
 * @method static bool createPersonFromCustomer(\Netflex\Customers\Customer $customer, string $role = 'student')
 * @method static array readPersonByCustomerId(string|int $customer)
 * @method static bool updatePersonFromCustomer(\Netflex\Customers\Customer $customer, string $role = 'student')
 * @method static bool deletePersonByCustomerId(string|int $customer)
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
