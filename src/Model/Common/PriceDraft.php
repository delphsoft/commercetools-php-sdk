<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomField\CustomFieldObject;

/**
 * @package Commercetools\Core\Model\Common
 *
 * @method Money getValue()
 * @method PriceDraft setValue(Money $value = null)
 * @method string getCountry()
 * @method PriceDraft setCountry(string $country = null)
 * @method CustomerGroupReference getCustomerGroup()
 * @method PriceDraft setCustomerGroup(CustomerGroupReference $customerGroup = null)
 * @method ChannelReference getChannel()
 * @method PriceDraft setChannel(ChannelReference $channel = null)
 * @method DateTimeDecorator getValidFrom()
 * @method PriceDraft setValidFrom(\DateTime $validFrom = null)
 * @method DateTimeDecorator getValidUntil()
 * @method PriceDraft setValidUntil(\DateTime $validUntil = null)
 * @method CustomFieldObject getCustom()
 * @method PriceDraft setCustom(CustomFieldObject $custom = null)
 */
class PriceDraft extends JsonObject
{
    const VALUE = 'value';
    const COUNTRY = 'country';
    const CUSTOMER_GROUP = 'customerGroup';
    const CHANNEL = 'channel';
    const VALID_FROM = 'validFrom';
    const VALID_UNTIL = 'validUntil';
    const DISCOUNTED = 'discounted';
    const CUSTOM = 'custom';

    public function fieldDefinitions()
    {
        return [
            static::VALUE => [self::TYPE => '\Commercetools\Core\Model\Common\Money'],
            static::COUNTRY => [self::TYPE => 'string'],
            static::CUSTOMER_GROUP => [self::TYPE => '\Commercetools\Core\Model\CustomerGroup\CustomerGroupReference'],
            static::CHANNEL => [self::TYPE => '\Commercetools\Core\Model\Channel\ChannelReference'],
            static::VALID_FROM => [
                self::TYPE => '\DateTime',
                self::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            static::VALID_UNTIL => [
                self::TYPE => '\DateTime',
                self::DECORATOR => '\Commercetools\Core\Model\Common\DateTimeDecorator'
            ],
            static::CUSTOM => [static::TYPE => '\Commercetools\Core\Model\CustomField\CustomFieldObject'],
        ];
    }

    /**
     * @param Money $money
     * @param Context|callable $context
     * @return Price
     */
    public static function ofMoney(Money $money, $context = null)
    {
        $price = static::of($context);
        return $price->setValue($money);
    }

    public function __toString()
    {
        return $this->getValue()->__toString();
    }
}
