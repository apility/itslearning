<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Soap\ItsLearningSoapClient;

use Netflex\Customers\Customer;

class MembershipManagementServiceSync extends ItsLearningSoapClient
{
    /** @var string */
    protected string $service = 'MembershipManagementServiceSync.svc';

    /**
     * @param string|int $identifier
     * @return array
     */
    public function createMembership(Customer $customer)
    {
        $payload = [
            'sourcedId' => [
                'identifier' => (string) $customer->id,
            ],
        ];

        return parent::readMembership($payload);
    }
}
