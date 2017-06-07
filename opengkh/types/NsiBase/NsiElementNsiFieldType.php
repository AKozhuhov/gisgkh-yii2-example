<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование и значение поля типа "Ссылка на справочник" для элемента справочника.
 */
class NsiElementNsiFieldType extends \gisgkh\types\NsiBase\NsiElementFieldType
{
    /**
     * Ссылка на справочник.
     * @var \gisgkh\types\NsiBase\NsiElementNsiFieldType\NsiRef $NsiRef
     */
    public $NsiRef;
}
