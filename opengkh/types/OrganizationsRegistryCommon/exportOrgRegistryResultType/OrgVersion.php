<?php

namespace gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType;

/**
 * Версия организации в реестре организаций
 */
class OrgVersion
{
    /**
     * Идентификатор версии записи в реестре организаций
     * @var string $orgVersionGUID
     */
    public $orgVersionGUID;

    /**
     * Время последнего изменения
     * @var \DateTime $lastEditingDate
     */
    public $lastEditingDate;

    /**
     * Признак актуальности записи
     * @var boolean $IsActual
     */
    public $IsActual;

    /**
     * Юридическое лицо
     * @var \gisgkh\types\OrganizationsRegistryBase\LegalType $Legal
     */
    public $Legal;

    /**
     * Обособленное подразделение
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType\OrgVersion\Subsidiary $Subsidiary
     */
    public $Subsidiary;

    /**
     * Индивидуальный предприниматель
     * @var \gisgkh\types\OrganizationsRegistryBase\EntpsType $Entrp
     */
    public $Entrp;

    /**
     * ФПИЮЛ (Филиал или представительство иностранного юридического лица)
     * @var \gisgkh\types\OrganizationsRegistryBase\ForeignBranchType $ForeignBranch
     */
    public $ForeignBranch;

    /**
     * Статус: (P)UBLISHED - опубликована в одном из документов в рамках раскрытия
     * @var string $registryOrganizationStatus
     */
    public $registryOrganizationStatus;
}
