<?php

namespace gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryRequest;

/**
 * Критерий поиска организаций.
 */
class SearchCriteria
{
    /**
     * ОГРНИП
     * @var string $OGRNIP
     */
    public $OGRNIP;

    /**
     * ОГРН
     * @var string $OGRN
     */
    public $OGRN;

    /**
     * КПП
     * @var string $KPP
     */
    public $KPP;

    /**
     * НЗА (Номер записи об аккредитации)
     * @var string $NZA
     */
    public $NZA;

    /**
     * Идентификатор версии записи в реестре организаций
     * @var string $orgVersionGUID
     */
    public $orgVersionGUID;

    /**
     * Идентификатор корневой сущности организации в реестре организаций
     * @var string $orgRootEntityGUID
     */
    public $orgRootEntityGUID;

    /**
     * Идентификатор зарегистрированной организации
     * @var string $orgPPAGUID
     */
    public $orgPPAGUID;

    /**
     * [READ ONLY] Поиск среди организаций, имеющих личных кабинет
     * @var boolean $isRegistered
     */
    public $isRegistered = true;
}
