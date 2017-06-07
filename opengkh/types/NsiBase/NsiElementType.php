<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Элемент справочника.
 */
class NsiElementType
{
    /**
     * Код элемента справочника, уникальный в пределах справочника.
     * @var string $Code
     */
    public $Code;

    /**
     * Глобально-уникальный идентификатор элемента справочника.
     * @var string $GUID
     */
    public $GUID;

    /**
     * Дата и время последнего изменения элемента справочника (в том числе создания).
     * @var \DateTime $Modified
     */
    public $Modified;

    /**
     * Дата начала действия значения
     * @var \DateTime $StartDate
     */
    public $StartDate;

    /**
     * Дата окончания действия значения
     * @var \DateTime $EndDate
     */
    public $EndDate;

    /**
     * Признак актуальности элемента справочника.
     * @var boolean $IsActual
     */
    public $IsActual;

    /**
     * Наименование и значение поля для элемента справочника.
     * @var \gisgkh\types\NsiBase\NsiElementFieldType[] $NsiElementField
     */
    public $NsiElementField;

    /**
     * Дочерний элемент.
     * @var \gisgkh\types\NsiBase\NsiElementType[] $ChildElement
     */
    public $ChildElement;
}
