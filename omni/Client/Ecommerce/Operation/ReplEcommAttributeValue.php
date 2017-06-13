<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Ecommerce\Operation;

use Ls\Omni\Client\IRequest;
use Ls\Omni\Client\IResponse;
use Ls\Omni\Client\AbstractOperation;
use Ls\Omni\Service\Service as OmniService;
use Ls\Omni\Service\ServiceType;
use Ls\Omni\Service\Soap\Client as OmniClient;
use Ls\Omni\Client\Ecommerce\ClassMap;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommAttributeValue as ReplEcommAttributeValueRequest;
use Ls\Omni\Client\Ecommerce\Entity\ReplEcommAttributeValueResponse as ReplEcommAttributeValueResponse;

class ReplEcommAttributeValue extends AbstractOperation
{

    const OPERATION_NAME = 'REPL_ECOMM_ATTRIBUTE_VALUE';

    const SERVICE_TYPE = 'ecommerce';

    /**
     * @property OmniClient $client
     */
    public $client = null;

    /**
     * @property ReplEcommAttributeValueRequest $request
     */
    private $request = null;

    /**
     * @property ReplEcommAttributeValueResponse $response
     */
    private $response = null;

    /**
     * @property ReplEcommAttributeValueRequest $request_xml
     */
    private $request_xml = null;

    /**
     * @property ReplEcommAttributeValueResponse $response_xml
     */
    private $response_xml = null;

    /**
     * @property mixed $error
     */
    private $error = null;

    /**
     * @param ServiceType $service_type
     */
    public function __construct()
    {
        $service_type = new ServiceType( self::SERVICE_TYPE );
        parent::__construct( $service_type );
        $url = OmniService::getUrl( $service_type ); 
        $this->client = new OmniClient( $url, $service_type );
        $this->client->setClassmap( $this->getClassMap() );
    }

    /**
     * @param ReplEcommAttributeValueRequest $request
     * @return IResponse|ReplEcommAttributeValueResponse
     */
    public function execute(IRequest $request = null)
    {
        if ( !is_null( $request ) ) {
            $this->setRequest( $request );
        }
        return $this->makeRequest( 'ReplEcommAttributeValue' );
    }

    /**
     * @return ReplEcommAttributeValueRequest
     */
    public function & getOperationInput()
    {
        if ( is_null( $this->request ) ) {
            $this->request = new ReplEcommAttributeValueRequest();
        }
        return $this->request;
    }

    /**
     * @return array
     */
    public function getClassMap()
    {
        return ClassMap::getClassMap();
    }

    /**
     * @param OmniClient $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return OmniClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ReplEcommAttributeValueRequest $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return ReplEcommAttributeValueRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param ReplEcommAttributeValueResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return ReplEcommAttributeValueResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ReplEcommAttributeValueRequest $request_xml
     * @return $this
     */
    public function setRequestXml($request_xml)
    {
        $this->request_xml = $request_xml;
        return $this;
    }

    /**
     * @return ReplEcommAttributeValueRequest
     */
    public function getRequestXml()
    {
        return $this->request_xml;
    }

    /**
     * @param ReplEcommAttributeValueResponse $response_xml
     * @return $this
     */
    public function setResponseXml($response_xml)
    {
        $this->response_xml = $response_xml;
        return $this;
    }

    /**
     * @return ReplEcommAttributeValueResponse
     */
    public function getResponseXml()
    {
        return $this->response_xml;
    }

    /**
     * @param mixed $error
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }


}

