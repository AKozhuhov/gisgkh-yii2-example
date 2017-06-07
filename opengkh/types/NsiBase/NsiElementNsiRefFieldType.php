<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование и значение поля типа "Ссылка на элемент внутреннего справочника" для элемента справочника.
 */
class NsiElementNsiRefFieldType extends \gisgkh\types\NsiBase\NsiElementFieldType
{
    /**
     * Ссылка на элемент внутреннего справочника.
     * @var \gisgkh\types\NsiBase\NsiElementNsiRefFieldType\NsiRef $NsiRef
     */
    public $NsiRef;
}
