<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request\Products;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Request\AbstractDeleteRequest;
use Commercetools\Core\Model\Product\Product;
use Commercetools\Core\Response\ApiResponseInterface;

/**
 * @package Commercetools\Core\Request\Products
 * @apidoc http://dev.sphere.io/http-api-projects-products.html#delete-product
 * @method Product mapResponse(ApiResponseInterface $response)
 */
class ProductDeleteRequest extends AbstractDeleteRequest
{
    protected $resultClass = '\Commercetools\Core\Model\Product\Product';

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     */
    public function __construct($id, $version, Context $context = null)
    {
        parent::__construct(ProductsEndpoint::endpoint(), $id, $version, $context);
    }

    /**
     * @param string $id
     * @param int $version
     * @param Context $context
     * @return static
     */
    public static function ofIdAndVersion($id, $version, Context $context = null)
    {
        return new static($id, $version, $context);
    }
}
