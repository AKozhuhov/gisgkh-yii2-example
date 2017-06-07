<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

class exportOrgRegistryResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Найденная организация.
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResultType[] $OrgData
     */
    public $OrgData;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.2.1";
}
