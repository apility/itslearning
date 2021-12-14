<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Services\MembershipManagementServiceSync;

class MembershipManagement extends Facade
{
    const ROLE_LEARNER = '01';
    const ROLE_INSTRUCTOR = '02';
    const ROLE_CONTENT_DEVELOPER = '03';
    const ROLE_MEMBER = '04';
    const ROLE_MANAGER = '05';
    const ROLE_ADMINISTRATOR = '07';
    const ROLE_TEACHING_ASSISTANT = '08';

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return MembershipManagementServiceSync::class;
    }
}
