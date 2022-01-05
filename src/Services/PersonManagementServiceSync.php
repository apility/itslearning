<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Facades\PersonManagement;
use Apility\ItsLearning\Models\Person;
use Apility\ItsLearning\Soap\ItsLearningSoapClient;

use Netflex\Customers\Customer;

class PersonManagementServiceSync extends ItsLearningSoapClient
{
    /** @var string */
    protected string $service = 'PersonManagementServiceSync.svc';

    /**
     * @param string|int $identifier
     * @return array
     */
    public function readPersonByCustomerId($identifier): ?array
    {
        $payload = [
            'sourcedId' => [
                'identifier' => (string) $identifier,
            ],
        ];

        $response = parent::readPerson($payload);

        if ($person = $response->person ?? null) {
            return json_decode(json_encode($person), true);
        }

        return null;
    }

    public function customerExists(Customer $customer): bool
    {
        $person  = $this->readPersonByCustomerId($customer->id);
        return (bool) $person;
    }

    /**
     * @param string|int $identifier
     * @return bool
     */
    public function deletePersonByCustomerId($identifier)
    {
        parent::deletePerson([
            'sourcedId' => [
                'identifier' => (string) $identifier,
            ]
        ]);

        return true;
    }

    /**
     * @param Customer $customer
     * @param string $role
     * @return bool
     */
    public function createPersonFromCustomer(Customer $customer, string $role = PersonManagement::ROLE_STUDENT, $additional = []): bool
    {
        $payload = $this->customerToPersonPayload($customer, $role);
        $payload = array_merge_recursive($payload, $additional);
        parent::createPerson($payload);

        return true;
    }

    /**
     * @param Customer $customer
     * @param string $role
     * @return bool
     */
    public function updatePersonFromCustomer(Customer $customer, string $role = PersonManagement::ROLE_STUDENT): bool
    {
        $payload = $this->customerToPersonPayload($customer, $role);
        parent::updatePerson($payload);

        return true;
    }

    protected function customerToPersonPayload(Customer $customer, $role = PersonManagement::ROLE_STUDENT): array
    {
        $payload = [
            'sourcedId' => [
                'identifier' => (string) $customer->id,
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

        return $payload;
    }
}
