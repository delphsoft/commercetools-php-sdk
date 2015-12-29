<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

use Commercetools\Core\Model\Channel\ChannelReference;
use Commercetools\Core\Model\CustomerGroup\CustomerGroupReference;
use Commercetools\Core\Request\Query\Parameter;
use Commercetools\Core\Request\Query\ParameterInterface;

/**
 * @method $this addParamObject(ParameterInterface $param)
 */
trait SelectTrait
{

    protected function select($key, $value)
    {
        if (!is_null($value)) {
            $this->addParamObject(new Parameter($key, $value));
        }

        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function currency($currency)
    {
        return $this->select('currency', $currency);
    }

    /**
     * @param string $country
     * @return $this
     */
    public function country($country)
    {
        return $this->select('country', $country);
    }

    /**
     * @param ChannelReference $channel
     * @return $this
     */
    public function channel(ChannelReference $channel)
    {
        return $this->select('channel', $channel->getId());
    }

    /**
     * @param CustomerGroupReference $customerGroup
     * @return $this
     */
    public function customerGroup(CustomerGroupReference $customerGroup)
    {
        return $this->select('customerGroup', $customerGroup->getId());
    }
}
