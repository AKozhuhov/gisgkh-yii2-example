<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

/**
 * Экспорт сведений из реестра организаций
 */
class exportOrgRegistryRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Критерий поиска организаций.
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryRequest\SearchCriteria[] $SearchCriteria
     */
    public $SearchCriteria;

    /**
     * Время последнего изменения (от)
     * @var \DateTime $lastEditingDateFrom
     */
    public $lastEditingDateFrom;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.2.1";
}
