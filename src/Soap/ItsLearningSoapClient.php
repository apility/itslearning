<?php

namespace Apility\ItsLearning\Soap;

use SoapClient;
use SoapVar;
use SoapHeader;

use Apility\ItsLearning\Contracts\AuthorizesClients;

abstract class ItsLearningSoapClient extends SoapClient
{
    const DOMAIN_PRODUCTION = 'enterprise.itslearning.com';
    const DOMAIN_SANDBOX = 'enterprise.itsltest.com';

    protected string $protocol = 'https';

    /** @var string */
    protected string $baseUri = 'WCFServiceLibrary';

    /** @var string */
    protected string $service;

    protected $sandbox = false;

    public function __construct(AuthorizesClients $auth, $options = [])
    {
        $this->sandbox = $auth->sandboxed();

        parent::__construct($this->wsdl(), array_merge([
            'exceptions' => true,
            'trace' => 1,
            'encoding' => 'UTF-8',
            'verify_peer_name' => false,
        ], $options));

        $auth->authorize($this);
    }

    protected function domain(): string
    {
        return $this->sandbox ? static::DOMAIN_SANDBOX : static::DOMAIN_PRODUCTION;
    }

    protected function url()
    {
        return $this->protocol . '://' . implode('/', [$this->domain(), $this->baseUri, $this->service]);
    }

    protected function wsdl()
    {
        return $this->url() . '?singleWsdl';
    }

    /**
     * @return SoapHeader
     */
    protected function authHeader(): SoapHeader
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
