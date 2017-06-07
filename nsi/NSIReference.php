<?php

namespace app\nsi;

use yii\base\Model;

use opengkh\gis\interfaces\nsi\DynamicReference\IDynamicReference;

/**
 * Справочник НСИ
 */
class NSIReference extends Model implements IDynamicReference
{
    /**
     * @var integer $registryNumber реестровый номер
     */
    public $registryNumber = null;

    /**
     * @var string $title наименование справочника
     */
    public $title = null;

    /**
     * @var \DateTime $modifiedAt дата и время последнего обновления
     */
    public $modifiedAt = null;

    /**
     * @var NSIElement[] $elements
     */
    public $elements = [];

    public function attributeLabels()
    {
        return [
            'title' => 'Название справочника',
            'registryNumber' => 'Номер'
        ];
    }

    /**
     * @return integer
     */
    public function getRegistryNumber()
    {
        return $this->registryNumber;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->title;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->title = $name;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $modifiedAt
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
    }

    /**
     * @param string $code
     * @return NSIElement
     */
    public function getElementByCode($code)
    {
        return @$this->elements[$code];
    }

    /**
     * @param string $code
     * @param string $guid
     * @return NSIElement
     */
    public function createElement($code, $guid)
    {
        $element = new NSIElement();
        $element->code = $code;
        $element->guid = $guid;
        $this->elements[$code] = $element;
        return $element;
    }
}