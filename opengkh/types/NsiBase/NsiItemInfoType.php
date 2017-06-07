<?php

namespace gisgkh\types\NsiBase;

/**
 * Составной тип. Наименование, дата и время последнего изменения справочника.
 */
class NsiItemInfoType
{
    /**
     * Реестровый номер справочника.
     * @var null $RegistryNumber
     */
    public $RegistryNumber;

    /**
     * Наименование справочника.
     * @var string $Name
     */
    public $Name;

    /**
     * Дата и время последнего изменения справочника.
     * @var \DateTime $Modified
     */
    public $Modified;
}
