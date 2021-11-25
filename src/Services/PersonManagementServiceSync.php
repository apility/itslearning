<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Models\Person;
use Apility\ItsLearning\Soap\ItsLearningSoapClient;

use Netflex\Customers\Customer;

class PersonManagementServiceSync extends ItsLearningSoapClient
{
    /** @var string */
    protected string $service = 'PersonManagementServiceSync.svc';

    /**
     * @param Customer $customer
     * @return Person|null
     */
    public function readPerson(Customer $customer): ?Person
    {
        $payload = [
            'sourcedId' => [
                'identifier' => $customer->id,
            ],
        ];

        $response = parent::{'readPerson'}($payload);

        if ($person = $response->person ?? null) {
            return new Person($person);
        }
    }

    /**
     * @param Customer $customer
     * @param string $role
     * @return Person|null
     */
    public function createPerson(Customer $customer, string $role = 'Student'): ?Person
    {
        $payload = [
            'sourcedId' => [
                'identifier' => $customer->id,
            ],
            'person' => [
                'name' => [
                    'partName' => [
                        [
                            'namePartType' => 'First',
                            'namePartValue' => $customer->firstname,
                        ],
                        [
                            'namePartType' => 'Last',
                            'namePartValue' => $customer->surname,
                        ]
                    ],
                ],
                'email' => $customer->mail,
                'institutionRole' => [
                    'institutionRoleType' => $role,
                    'primaryRoleType' => true
                ],
            ],
        ];

        if ($customer->phone) {
            $payload['person']['tel'] = $payload['person']['tel'] ?? [];
            $payload['person']['tel'][] = [
                'telType' => 'Mobile',
                'telValue' => $customer->phone,
            ];
        }

        parent::{'createPerson'}($payload);

        return $this->readPerson($customer);
    }
}
