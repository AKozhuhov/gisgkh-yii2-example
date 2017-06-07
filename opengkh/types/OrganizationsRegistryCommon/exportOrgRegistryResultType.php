<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

class exportOrgRegistryResultType
{
    /**
     * Идентификатор корневой сущности организации в реестре организаций
     * @var string $orgRootEntityGUID
     */
    public $orgRootEntityGUID;

    /**
     * Версия организации в реестре организаций
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType\OrgVersion $OrgVersion
     */
    public $OrgVersion;

    /**
     * Идентификатор зарегистрированной организации
     * @var string $orgPPAGUID
     */
    public $orgPPAGUID;

    /**
     * Полномочие организации (НСИ №20)
     * @var \gisgkh\types\NsiBase\nsiRef[] $organizationRoles
     */
    public $organizationRoles;

    /**
     * [READ ONLY] Зарегистрирована в ГИС ЖКХ
     * @var boolean $isRegistered
     */
    public $isRegistered = true;
}
