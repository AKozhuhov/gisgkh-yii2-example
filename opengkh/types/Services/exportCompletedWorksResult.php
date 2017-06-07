<?php

namespace gisgkh\types\Services;

class exportCompletedWorksResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Выполненная работа за период (для экспорта, без TransportGUID)
     * @var \gisgkh\types\Services\exportCompletedWorksResultType[] $exportCompletedWorksResult
     */
    public $exportCompletedWorksResult;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
