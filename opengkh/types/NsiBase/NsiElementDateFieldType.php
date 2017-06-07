<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование и значение поля типа "Дата" для элемента справочника.
 */
class NsiElementDateFieldType extends \gisgkh\types\NsiBase\NsiElementFieldType
{
    /**
     * Значение поля элемента справочника типа "Дата".
     * @var \DateTime $Value
     */
    public $Value;
}
