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
use Ls\Omni\Client\Ecommerce\Entity\PublishedOffersGetByCardId as PublishedOffersGetByCardIdRequest;
use Ls\Omni\Client\Ecommerce\Entity\PublishedOffersGetByCardIdResponse as PublishedOffersGetByCardIdResponse;

class PublishedOffersGetByCardId extends AbstractOperation
{

    const OPERATION_NAME = 'PUBLISHED_OFFERS_GET_BY_CARD_ID';

    const SERVICE_TYPE = 'ecommerce';

    /**
     * @property OmniClient $client
     */
    public $client = null;

    /**
     * @property PublishedOffersGetByCardIdRequest $request
     */
    private $request = null;

    /**
     * @property PublishedOffersGetByCardIdResponse $response
     */
    private $response = null;

    /**
     * @property PublishedOffersGetByCardIdRequest $request_xml
     */
    private $request_xml = null;

    /**
     * @property PublishedOffersGetByCardIdResponse $response_xml
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
     * @param PublishedOffersGetByCardIdRequest $request
     * @return IResponse|PublishedOffersGetByCardIdResponse
     */
    public function execute(IRequest $request = null)
    {
        if ( !is_null( $request ) ) {
            $this->setRequest( $request );
        }
        return $this->makeRequest( 'PublishedOffersGetByCardId' );
    }

    /**
     * @return PublishedOffersGetByCardIdRequest
     */
    public function & getOperationInput()
    {
        if ( is_null( $this->request ) ) {
            $this->request = new PublishedOffersGetByCardIdRequest();
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
     * @param PublishedOffersGetByCardIdRequest $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return PublishedOffersGetByCardIdRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param PublishedOffersGetByCardIdResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return PublishedOffersGetByCardIdResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param PublishedOffersGetByCardIdRequest $request_xml
     * @return $this
     */
    public function setRequestXml($request_xml)
    {
        $this->request_xml = $request_xml;
        return $this;
    }

    /**
     * @return PublishedOffersGetByCardIdRequest
     */
    public function getRequestXml()
    {
        return $this->request_xml;
    }

    /**
     * @param PublishedOffersGetByCardIdResponse $response_xml
     * @return $this
     */
    public function setResponseXml($response_xml)
    {
        $this->response_xml = $response_xml;
        return $this;
    }

    /**
     * @return PublishedOffersGetByCardIdResponse
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

