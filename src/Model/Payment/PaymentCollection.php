<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Payment;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Payment
 *
 * @method PaymentCollection add(Payment $element)
 * @method Payment current()
 * @method Payment getAt($offset)
 */
class PaymentCollection extends Collection
{
    const ID = 'id';
    protected $type = '\Commercetools\Core\Model\Payment\Payment';


    protected function indexRow($offset, $row)
    {
        if ($row instanceof Payment) {
            $id = $row->getId();
        } else {
            $id = $row[static::ID];
        }
        $this->addToIndex(static::ID, $offset, $id);
    }

    /**
     * @param $id
     * @return Payment
     */
    public function getById($id)
    {
        return $this->getBy(static::ID, $id);
    }
}