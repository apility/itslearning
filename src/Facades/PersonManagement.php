<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Services\PersonManagementServiceSync;
use Apility\ItsLearning\Models\Person;

/**
 * @method static bool createPersonFromCustomer(\Netflex\Customers\Customer $customer, string $role = 'Student')
 * @method static array readPersonByCustomerId(string|int $customer)
 * @method static bool updatePersonFromCustomer(\Netflex\Customers\Customer $customer, string $role = 'Student')
 * @method static bool deletePersonByCustomerId(string|int $customer)
 */
class PersonManagement extends Facade
{
    const ROLE_STUDENT = 'Student';
    const ROLE_Faculty = 'Faculty';
    const ROLE_MEMBER = 'Member';
    const ROLE_LEARNER = 'Learner';
    const ROLE_INSTRUCTOR = 'Instructor';
    const ROLE_MENTOR = 'Mentor';
    const ROLE_STAFF = 'Staff';
    const ROLE_ALUMNI = 'Alumni';
    const ROLE_PROSPECTIVE_STUDENT = 'ProspectiveStudent';
    const ROLE_GUEST = 'Guest';
    const ROLE_OTHER = 'Other';
    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_OBSERVER = 'Observer';
    const ROLE_CARER = 'Carer';

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
