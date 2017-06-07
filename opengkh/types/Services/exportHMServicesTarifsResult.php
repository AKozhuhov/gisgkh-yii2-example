<?php

namespace gisgkh\types\Services;

class exportHMServicesTarifsResult extends \gisgkh\types\Base\BaseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Документ. Тарифы ЖКУ
     * @var \gisgkh\types\Services\exportHMServicesTarifsResultType[] $exportHMServicesTarifsResult
     */
    public $exportHMServicesTarifsResult;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
