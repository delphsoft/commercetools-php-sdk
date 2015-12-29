<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\CustomField;

use Commercetools\Core\Model\Common\Context;
use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Type\TypeReference;
use Commercetools\Core\Model\Common\ResourceIdentifier;

/**
 * @package Commercetools\Core\Model\CustomField
 *
 * @method string getTypeKey()
 * @method CustomFieldObjectDraft setTypeKey(string $typeKey = null)
 * @method FieldContainer getFields()
 * @method CustomFieldObjectDraft setFields(FieldContainer $fields = null)
 * @method string getTypeId()
 * @method CustomFieldObjectDraft setTypeId(string $typeId = null)
 * @method ResourceIdentifier getType()
 * @method CustomFieldObjectDraft setType(ResourceIdentifier $type = null)
 */
class CustomFieldObjectDraft extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => '\Commercetools\Core\Model\Common\ResourceIdentifier'],
            'fields' => [static::TYPE => '\Commercetools\Core\Model\CustomField\FieldContainer']
        ];
    }

    /**
     * @param $typeKey
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeKey($typeKey, $context = null)
    {
        $draft = static::of($context)->setTypeKey($typeKey);

        return $draft;
    }

    /**
     * @param string $typeId
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofTypeId($typeId, $context = null)
    {
        $draft = static::of($context)->setTypeId($typeId);

        return $draft;
    }

    /**
     * @param TypeReference $type
     * @param Context|callable $context
     * @return CustomFieldObjectDraft
     */
    public static function ofType(TypeReference $type, $context = null)
    {
        $draft = static::of($context)->setTypeId($type->getId());

        return $draft;
    }
}
