<?php

namespace Apility\ItsLearning\Facades;

use Illuminate\Support\Facades\Facade;
use Apility\ItsLearning\Services\GroupManagementServiceSync;

class GroupManagement extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GroupManagementServiceSync::class;
    }
}
