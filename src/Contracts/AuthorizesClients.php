<?php

namespace Apility\ItsLearning\Contracts;

use SoapClient;

interface AuthorizesClients
{
    public function authorize(SoapClient $client): SoapClient;

    public function sandboxed(): bool;
}
