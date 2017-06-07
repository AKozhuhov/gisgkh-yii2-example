<?php

namespace gisgkh\types\OrganizationsRegistryBase;

/**
 * ОП (Обособленное подразделение)
 */
class SubsidiaryType
{
    /**
     * Полное наименование
     * @var string $FullName
     */
    public $FullName;

    /**
     * Сокращенное наименование
     * @var string $ShortName
     */
    public $ShortName;

    /**
     * ОГРН
     * @var string $OGRN
     */
    public $OGRN;

    /**
     * ИНН
     * @var string $INN
     */
    public $INN;

    /**
     * КПП
     * @var string $KPP
     */
    public $KPP;

    /**
     * ОКОПФ
     * @var string $OKOPF
     */
    public $OKOPF;

    /**
     * Адрес регистрации
     * @var string $Address
     */
    public $Address;

    /**
     * Адрес регистрации (Глобальный уникальный идентификатор дома по ФИАС)
     * @var string $FIASHouseGuid
     */
    public $FIASHouseGuid;

    /**
     * Дата прекращения деятельности
     * @var \DateTime $ActivityEndDate
     */
    public $ActivityEndDate;

    /**
     * Источник информации
     * @var \gisgkh\types\OrganizationsRegistryBase\SubsidiaryType\SourceName $SourceName
     */
    public $SourceName;
}
