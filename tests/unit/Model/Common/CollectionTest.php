<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Sphere\Core\Error\InvalidArgumentException;
use Sphere\Core\Model\Product\ProductProjectionCollection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    protected function getCollection()
    {
        $collection = new Collection();

        $obj = $this->getMock(
            '\Sphere\Core\Model\Common\JsonObject',
            ['getFields'],
            [['key' => 'value', 'true' => true, 'false' => false]]
        );
        $obj->expects($this->any())
            ->method('getFields')
            ->will(
                $this->returnValue(
                    [
                        'key' => [JsonObject::TYPE => 'string'],
                        'dummy' => [JsonObject::TYPE => 'string'],
                        'true' => [JsonObject::TYPE => 'bool'],
                        'false' => [JsonObject::TYPE => 'bool'],
                        'localString' => [JsonObject::TYPE => '\Sphere\Core\Model\Common\LocalizedString'],
                        'mixed' => [],
                        'decorator' => [
                            JsonObject::TYPE => '\DateTime',
                            JsonObject::DECORATOR => '\Sphere\Core\Model\Common\DateTimeDecorator'
                        ]
                    ]
                )
            );

        $collection->add($obj);

        return $collection;
    }

    public function testSerializable()
    {
        $this->assertJsonStringEqualsJsonString(
            json_encode([['key' => 'value', 'true' => true, 'false' => false]]),
            json_encode($this->getCollection())
        );
    }

    public function testInterface()
    {
        $this->assertInstanceOf('\JsonSerializable', $this->getCollection());
    }

    public function testOf()
    {
        $this->assertInstanceOf('\Sphere\Core\Model\Common\Collection', Collection::of());
    }

    public function testSetType()
    {
        $obj = new Collection();
        $obj->setType('\DateTime');
        $obj->add(new \DateTime());

        $this->assertInstanceOf('\DateTime', $obj->getAt(0));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongType()
    {
        $obj = new Collection();
        $obj->setType('\DateTime');
        $obj->add('test');
    }

    public function testFromArray()
    {
        $obj = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $obj->setType('\Sphere\Core\Model\Common\Money');
        $this->assertInstanceOf('\Sphere\Core\Model\Common\Money', $obj->getAt(0));
        $this->assertSame('EUR', $obj->getAt(0)->getCurrencyCode());
        $this->assertSame(100, $obj->getAt(0)->getCentAmount());
    }

    public function testCount()
    {
        $obj = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $this->assertSame(2, count($obj));
    }

    public function testIterator()
    {
        $collection = Collection::fromArray([
            ['currencyCode' => 'EUR', 'centAmount' => 100],
            ['currencyCode' => 'USD', 'centAmount' => 110]
        ]);
        $collection->setType('\Sphere\Core\Model\Common\Money');

        $i = 0;
        foreach ($collection as $key => $obj) {
            $this->assertSame($key, $i);
            $this->assertInstanceOf('\Sphere\Core\Model\Common\Money', $obj);
            $i++;
        }
    }

    public function testOffsetSet()
    {
        $collection = new Collection();
        $collection->setType('\DateTime');
        $collection[] = new \DateTime();

        $this->assertInstanceOf('\DateTime', $collection[0]);
    }

    public function testOffsetUnset()
    {
        $collection = new Collection();
        $collection->setType('\DateTime');
        $collection[] = new \DateTime();
        unset($collection[0]);

        $this->assertCount(0, $collection);
    }

    public function testIndex()
    {
        $collection = ProductProjectionCollection::fromArray([['id' => '12345']]);
        $this->assertInstanceOf('\Sphere\Core\Model\Product\ProductProjection', $collection->getById('12345'));
    }

    public function testNotIndexed()
    {
        $collection = ProductProjectionCollection::fromArray([['id' => '12345']]);
        $this->assertNull($collection->getById('123'));
    }

    public function testGetReturnRaw()
    {
        $collection = $this->getMock(
            '\Sphere\Core\Model\Common\Collection',
            ['initialize'],
            [[new \DateTime('2015-01-01')]]
        );
        $collection->setType('\DateTime');
        $this->assertSame('2015-01-01', $collection->getAt(0)->format('Y-m-d'));
    }

    public function testSetAt()
    {
        $collection = new Collection();
        $collection->setType('\DateTime');
        $collection[1] = new \DateTime();

        $this->assertInstanceOf('\DateTime', $collection[1]);

    }
}