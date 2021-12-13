<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Soap\ItsLearningSoapClient;

class GroupManagementServiceSync extends ItsLearningSoapClient
{
    /** @var string */
    protected string $service = 'GroupManagementServiceSync.svc';

    /**
     * @param string|int $identifier
     * @return array
     */
    public function readMembership($identifier)
    {
        $payload = [
            'sourcedId' => [
                'identifier' => (string) $identifier,
            ],
        ];

        return parent::readMembership($payload);
    }
}
