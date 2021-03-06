<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Product;

use Commercetools\Core\Model\Common\Collection;

/**
 * @package Commercetools\Core\Model\Product
 * @method FacetResult current()
 * @method FacetResultCollection add(FacetResult $element)
 * @method FacetResult getAt($offset)
 */
class FacetResultCollection extends Collection
{
    const OFFSET = 'offset';

    protected $type = FacetResult::class;

    /**
     * @param $name
     * @return FacetResult
     */
    public function getByName($name)
    {
        return $this->getAt($name);
    }
}
