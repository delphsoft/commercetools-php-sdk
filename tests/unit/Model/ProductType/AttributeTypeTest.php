<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\ProductType;


class AttributeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testTypeEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'enum'
        ]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\Enum', $type->getValues()->getAt(0));
    }

    public function testTypeLocalizedEnum()
    {
        $type = AttributeType::fromArray([
            'name' => 'lenum'
        ]);
        $this->assertInstanceOf('\Sphere\Core\Model\Common\LocalizedEnum', $type->getValues()->getAt(0));
    }

}