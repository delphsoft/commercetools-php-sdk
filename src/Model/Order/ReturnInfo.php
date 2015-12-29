<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Order;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\DateTimeDecorator;

/**
 * @package Commercetools\Core\Model\Order
 * @apidoc http://dev.sphere.io/http-api-projects-orders.html#return-info
 * @method ReturnItemCollection getItems()
 * @method ReturnInfo setItems(ReturnItemCollection $items = null)
 * @method string getReturnTrackingId()
 * @method ReturnInfo setReturnTrackingId(string $returnTrackingId = null)
 * @method DateTimeDecorator getReturnDate()
 * @method ReturnInfo setReturnDate(\DateTime $returnDate = null)
 */
class ReturnInfo extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'items' => [static::TYPE => '\Commercetools\Core\Model\Order\ReturnItemCollection'],
            'returnTrackingId' => [static::TYPE => 'string'],
            'returnDate' => [
                static::TYPE => '\DateTime',
                static::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ]
        ];
    }
}
