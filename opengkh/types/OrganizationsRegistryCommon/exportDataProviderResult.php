<?php

namespace gisgkh\types\OrganizationsRegistryCommon;

class exportDataProviderResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * 
     * @var \gisgkh\types\OrganizationsRegistryCommon\exportDataProviderResultType[] $exportDataProviderResult
     */
    public $exportDataProviderResult;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.2.1";
}
