<?php

namespace gisgkh\types\Services;

class exportWorkingListResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * 
     * @var \gisgkh\types\Services\exportWorkingListResultType[] $exportWorkingListResult
     */
    public $exportWorkingListResult;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "11.1.0.8";
}
