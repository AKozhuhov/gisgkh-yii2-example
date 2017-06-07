<?php

namespace gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType\OrgVersion;

/**
 * Обособленное подразделение
 */
class Subsidiary extends \gisgkh\types\OrganizationsRegistryBase\SubsidiaryType
{
    /**
     * Статус версии 
     * @var string $StatusVersion
     */
    public $StatusVersion;

    /**
     * Информация о головной организации
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType\OrgVersion\Subsidiary\ParentOrg $ParentOrg
     */
    public $ParentOrg;
}
