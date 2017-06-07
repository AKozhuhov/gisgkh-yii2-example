<?php

namespace gisgkh\types\Services;

/**
 * Возврат статуса отправленного сообщения
 */
class getStateResult extends \gisgkh\types\Base\BaseAsyncResponseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Результат выполнения C_UD
     * @var \gisgkh\types\Base\CommonResultType[] $ImportResult
     */
    public $ImportResult;

    /**
     * Документ. Тарифы ЖКУ
     * @var \gisgkh\types\Services\exportHMServicesTarifsResultType[] $exportHMServicesTarifsResult
     */
    public $exportHMServicesTarifsResult;

    /**
     * Выполненная работа за период (для экспорта, без TransportGUID)
     * @var \gisgkh\types\Services\exportCompletedWorksResultType[] $exportCompletedWorksResult
     */
    public $exportCompletedWorksResult;

    /**
     * 
     * @var \gisgkh\types\Services\exportWorkingListResultType[] $exportWorkingListResult
     */
    public $exportWorkingListResult;

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
