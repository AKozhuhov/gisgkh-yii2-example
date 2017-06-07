<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование и значение поля типа "Ссылка на элемент справочника ОКЕИ" для элемента справочника.
 */
class NsiElementOkeiRefFieldType extends \gisgkh\types\NsiBase\NsiElementFieldType
{
    /**
     * Код единицы измерения по справочнику ОКЕИ.
     * @var string $Code
     */
    public $Code;
}
