<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 17:25
 */

namespace Sphere\Core\Request;


use Sphere\Core\Http\HttpMethod;
use Sphere\Core\Http\HttpRequest;
use Sphere\Core\Response\SingleResourceResponse;

/**
 * Class AbstractFetchByIdRequest
 * @package Sphere\Core\Request
 */
abstract class AbstractFetchByIdRequest extends AbstractApiRequest
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @param mixed $id
     */
    public function __construct($endpoint, $id)
    {
        parent::__construct($endpoint);
        $this->setId($id);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return HttpRequest
     */
    public function httpRequest()
    {
        return new HttpRequest(HttpMethod::GET, (string)$this->getEndpoint() . '/' . $this->getId());
    }

    /**
     * @param $response
     * @return SingleResourceResponse
     */
    public function buildResponse($response)
    {
        return new SingleResourceResponse($response, $this);
    }

}
