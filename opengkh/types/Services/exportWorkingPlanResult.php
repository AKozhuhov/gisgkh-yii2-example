<?php

namespace gisgkh\types\Services;

class exportWorkingPlanResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * 
     * @var \gisgkh\types\Services\exportWorkingPlanResultType[] $exportWorkingPlanResult
     */
    public $exportWorkingPlanResult;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
