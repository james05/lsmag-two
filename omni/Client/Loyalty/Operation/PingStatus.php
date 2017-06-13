<?php
/**
 * THIS IS AN AUTOGENERATED FILE
 * DO NOT MODIFY
 */


namespace Ls\Omni\Client\Loyalty\Operation;

use Ls\Omni\Client\IRequest;
use Ls\Omni\Client\IResponse;
use Ls\Omni\Client\AbstractOperation;
use Ls\Omni\Service\Service as OmniService;
use Ls\Omni\Service\ServiceType;
use Ls\Omni\Service\Soap\Client as OmniClient;
use Ls\Omni\Client\Loyalty\ClassMap;
use Ls\Omni\Client\Loyalty\Entity\PingStatus as PingStatusRequest;
use Ls\Omni\Client\Loyalty\Entity\PingStatusResponse as PingStatusResponse;

class PingStatus extends AbstractOperation
{

    const OPERATION_NAME = 'PING_STATUS';

    const SERVICE_TYPE = 'loyalty';

    /**
     * @property OmniClient $client
     */
    public $client = null;

    /**
     * @property PingStatusRequest $request
     */
    private $request = null;

    /**
     * @property PingStatusResponse $response
     */
    private $response = null;

    /**
     * @property PingStatusRequest $request_xml
     */
    private $request_xml = null;

    /**
     * @property PingStatusResponse $response_xml
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
     * @param PingStatusRequest $request
     * @return IResponse|PingStatusResponse
     */
    public function execute(IRequest $request = null)
    {
        if ( !is_null( $request ) ) {
            $this->setRequest( $request );
        }
        return $this->makeRequest( 'PingStatus' );
    }

    /**
     * @return PingStatusRequest
     */
    public function & getOperationInput()
    {
        if ( is_null( $this->request ) ) {
            $this->request = new PingStatusRequest();
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
     * @param PingStatusRequest $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return PingStatusRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PingStatusResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return PingStatusResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param PingStatusRequest $request_xml
     * @return $this
     */
    public function setRequestXml($request_xml)
    {
        $this->request_xml = $request_xml;
        return $this;
    }

    /**
     * @return PingStatusRequest
     */
    public function getRequestXml()
    {
        return $this->request_xml;
    }

    /**
     * @param PingStatusResponse $response_xml
     * @return $this
     */
    public function setResponseXml($response_xml)
    {
        $this->response_xml = $response_xml;
        return $this;
    }

    /**
     * @return PingStatusResponse
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

