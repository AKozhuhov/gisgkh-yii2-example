<?php

namespace app\nsi;

use yii\base\Model;

use gisgkh\types\lib\nsi\NsiElementFieldType;
use opengkh\gis\interfaces\nsi\DynamicReference\IDynamicElement;

/**
 * Элемент справочника НСИ
 */
class NSIElement extends Model implements IDynamicElement
{

    /**
     * @var string $guid
     */
    public $guid = null;

    /**
     * @var string $code
     */
    public $code = null;

    /**
     * @var NsiElementFieldType[] $fields
     */
    public $fields = [];

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getGuid()
    {
        // TODO: Implement getGuid() method.
    }

    public function getIsActual()
    {
        // TODO: Implement getIsActual() method.
    }

    public function setIsActual($isActual)
    {
        // TODO: Implement setIsActual() method.
    }

    public function getModifiedAt()
    {
        // TODO: Implement getModifiedAt() method.
    }

    public function setModifiedAt($modifiedAt)
    {
        // TODO: Implement setModifiedAt() method.
    }

    public function getEffectiveDate()
    {
        // TODO: Implement getEffectiveDate() method.
    }

    public function setEffectiveDate($effectiveDate)
    {
        // TODO: Implement setEffectiveDate() method.
    }

    public function getExpiryDate()
    {
        // TODO: Implement getExpiryDate() method.
    }

    public function setExpiryDate($expiryDate)
    {
        // TODO: Implement setExpiryDate() method.
    }

    public function setParentElement($element)
    {
        // TODO: Implement setParentElement() method.
    }

    public function archive()
    {
        // TODO: Implement archive() method.
    }

    /**
     * @param NsiElementFieldType[] $fields
     */
    public function setFields($fields)
    {
        foreach ($fields as $field) {
            $this->fields[$field->Name] = $field;
        }
    }
}