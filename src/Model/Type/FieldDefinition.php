<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Type;

use Commercetools\Core\Model\Common\JsonObject;
use Commercetools\Core\Model\Common\LocalizedString;

/**
 * @package Commercetools\Core\Model\Type
 * @method FieldType getType()
 * @method FieldDefinition setType(FieldType $type = null)
 * @method string getName()
 * @method FieldDefinition setName(string $name = null)
 * @method LocalizedString getLabel()
 * @method FieldDefinition setLabel(LocalizedString $label = null)
 * @method bool getIsRequired()
 * @method FieldDefinition setIsRequired(bool $isRequired = null)
 * @method string getInputHint()
 * @method FieldDefinition setInputHint(string $inputHint = null)
 */
class FieldDefinition extends JsonObject
{
    public function fieldDefinitions()
    {
        return [
            'type' => [static::TYPE => '\Commercetools\Core\Model\Type\FieldType'],
            'name' => [static::TYPE => 'string'],
            'label' => [static::TYPE => '\Commercetools\Core\Model\Common\LocalizedString'],
            'isRequired' => [static::TYPE => 'bool'],
            'inputHint' => [static::TYPE => 'string'],
        ];
    }
}
