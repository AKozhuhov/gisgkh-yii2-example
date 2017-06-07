<?php

namespace gisgkh\types\OrganizationsRegistryBase;

/**
 * ФПИЮЛ (Филиал или представительство иностранного юридического лица)
 */
class ForeignBranchType
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
     * НЗА (Номер записи об аккредитации)
     * @var string $NZA
     */
    public $NZA;

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
     * Адрес места нахождения(жительства)_текст
     * @var string $Address
     */
    public $Address;

    /**
     * Адрес места нахождения(жительства)_ФИАС 
     * @var string $FIASHouseGuid
     */
    public $FIASHouseGuid;

    /**
     * Дата внесения записи в реестр аккредитованных
     * @var \DateTime $AccreditationStartDate
     */
    public $AccreditationStartDate;

    /**
     * Дата прекращения действия аккредитации
     * @var \DateTime $AccreditationEndDate
     */
    public $AccreditationEndDate;

    /**
     * Страна регистрации иностранного ЮЛ (Справочник ОКСМ, альфа-2)
     * @var string $RegistrationCountry
     */
    public $RegistrationCountry;
}
