<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип ошибки контроля или бизнес-процесса
 */
class ErrorMessageType
{
    /**
     * Код ошибки
     * @var string $ErrorCode
     */
    public $ErrorCode;

    /**
     * Описание ошибки
     * @var string $Description
     */
    public $Description;

    /**
     * StackTrace в случае возникновения исключения
     * @var string $StackTrace
     */
    public $StackTrace;
}
