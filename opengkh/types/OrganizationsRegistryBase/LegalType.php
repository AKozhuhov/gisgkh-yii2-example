<?php

namespace gisgkh\types\OrganizationsRegistryBase;

/**
 * Юридическое лицо
 */
class LegalType
{
    /**
     * Сокращенное наименование
     * @var string $ShortName
     */
    public $ShortName;

    /**
     * Полное наименование
     * @var string $FullName
     */
    public $FullName;

    /**
     * Фирменное наименование
     * @var string $CommercialName
     */
    public $CommercialName;

    /**
     * ОГРН
     * @var string $OGRN
     */
    public $OGRN;

    /**
     * Дата государственной регистрации
     * @var \DateTime $StateRegistrationDate
     */
    public $StateRegistrationDate;

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
}
