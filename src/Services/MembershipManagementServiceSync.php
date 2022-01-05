<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Facades\MembershipManagement;
use Apility\ItsLearning\Soap\ItsLearningSoapClient;
use App\Models\CourseMembership;
use Netflex\Customers\Customer;

class MembershipManagementServiceSync extends ItsLearningSoapClient
{
    /** @var string */
    protected string $service = 'MembershipManagementServiceSync.svc';

    /**
     * @param string|int $identifier
     * @return array
     */
    public function createMembership(string $membershipId, Customer $customer, string $groupId, string $role = MembershipManagement::ROLE_LEARNER)
    {
        $payload = [
            'sourcedId' => [
                'identifier' => $membershipId,
            ],
            'membership' => [
                'groupSourcedId' => [
                    'identifier' => $groupId,
                ],
                'member' => [
                    'memberSourcedId' => [
                        'identifier' => (string) $customer->id
                    ],
                    'role' => [
                        'roleType' => $role
                    ]
                ],
            ]
        ];

        parent::createMembership($payload);

        return $membershipId;
    }

    public function readMembershipsForPerson(string $person)
    {
        $payload = [
            'personSourcedId' => [
                'identifier' => $person,
            ]
        ];

        return parent::readMembershipsForPerson($payload)->membershipIDPairSet;
    }

    public function deleteMembership($syncId)
    {
        $payload = [
            'sourcedId' => [
                'identifier' => $syncId,
            ]
        ];

        return parent::deleteMembership($payload);
    }
}
