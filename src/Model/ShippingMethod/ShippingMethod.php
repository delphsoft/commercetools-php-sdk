<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ShippingMethod;

use Sphere\Core\Model\Common\JsonObject;
use Sphere\Core\Model\TaxCategory\TaxCategoryReference;

/**
 * Class ShippingMethod
 * @package Sphere\Core\Model\ShippingMethod
 * @method string getId()
 * @method ShippingMethod setId(string $id = null)
 * @method int getVersion()
 * @method ShippingMethod setVersion(int $version = null)
 * @method \DateTime getCreatedAt()
 * @method ShippingMethod setCreatedAt(\DateTime $createdAt = null)
 * @method \DateTime getLastModifiedAt()
 * @method ShippingMethod setLastModifiedAt(\DateTime $lastModifiedAt = null)
 * @method string getName()
 * @method ShippingMethod setName(string $name = null)
 * @method string getDescription()
 * @method ShippingMethod setDescription(string $description = null)
 * @method TaxCategoryReference getTaxCategory()
 * @method ShippingMethod setTaxCategory(TaxCategoryReference $taxCategory = null)
 * @method ZoneRateCollection getZoneRates()
 * @method ShippingMethod setZoneRates(ZoneRateCollection $zoneRates = null)
 * @method bool getIsDefault()
 * @method ShippingMethod setIsDefault(bool $isDefault = null)
 */
class ShippingMethod extends JsonObject
{
    public function getFields()
    {
        return [
            'id' => [static::TYPE => 'string'],
            'version' => [static::TYPE => 'int'],
            'createdAt' => [static::TYPE => '\DateTime'],
            'lastModifiedAt' => [static::TYPE => '\DateTime'],
            'name' => [static::TYPE => 'string'],
            'description' => [static::TYPE => 'string'],
            'taxCategory' => [static::TYPE => '\Sphere\Core\Model\TaxCategory\TaxCategoryReference'],
            'zoneRates' => [static::TYPE => '\Sphere\Core\Model\ShippingMethod\ZoneRateCollection'],
            'isDefault' => [static::TYPE => 'bool']
        ];
    }
}