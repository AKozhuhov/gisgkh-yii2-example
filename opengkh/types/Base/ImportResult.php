<?php

namespace gisgkh\types\Base;

/**
 * Статус обработки импорта данных при синхронном обмене
 */
class ImportResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Результат выполнения C_UD
     * @var \gisgkh\types\Base\CommonResultType[] $CommonResult
     */
    public $CommonResult;
}
