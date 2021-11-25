<?php

namespace Apility\ItsLearning\Services;

use Apility\ItsLearning\Contracts\AuthorizesClients;

use SoapClient;
use SoapHeader;
use SoapVar;

class Authentication implements AuthorizesClients
{
    /** @var string */
    protected string $username;

    /** @var string */
    protected string $password;

    /** @var bool */
    protected bool $sandbox;

    public function __construct(string $username, string $password, bool $sandbox = false)
    {
        $this->username = $username;
        $this->password = $password;
        $this->sandbox = $sandbox;
    }

    public function authorize(SoapClient $client): SoapClient
    {
        $client->__setSoapHeaders([$this->buildAuthHeader()]);
        return $client;
    }

    public function sandboxed(): bool
    {
        return $this->sandbox;
    }

    protected function buildAuthHeader(): SoapHeader
    {
        $namespace = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
        $container = 'Security';

        $wsseAuth = (object) [
            'Username' => new SoapVar($this->username, XSD_STRING, null, $namespace, null, $namespace),
            'Password' => new SoapVar($this->password, XSD_STRING, null, $namespace, null, $namespace)
        ];

        $wsseToken = (object) [
            'UsernameToken' => new SoapVar(
                $wsseAuth,
                SOAP_ENC_OBJECT,
                null,
                $namespace,
                'UsernameToken',
                $namespace
            )
        ];

        $objSoapVarWSSEToken = new SoapVar(
            $wsseToken,
            SOAP_ENC_OBJECT,
            null,
            $namespace,
            'UsernameToken',
            $namespace
        );

        $header = new SoapVar(
            $objSoapVarWSSEToken,
            SOAP_ENC_OBJECT,
            null,
            $namespace,
            $container,
            $namespace
        );

        return new SoapHeader($namespace, $container, $header);
    }
}
