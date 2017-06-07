<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

class exportDataProviderResultType
{
    /**
     * Идентификатор поставщика данных
     * @var string $DataProviderGUID
     */
    public $DataProviderGUID;

    /**
     * Статус связи: 1 - аткивен, 0- отключен
     * @var boolean $IsActual
     */
    public $IsActual;

    /**
     * Организация в реестре организаций
     * @var \gisgkh\types\OrganizationsRegistryBase\RegOrgType $RegOrg
     */
    public $RegOrg;
}
