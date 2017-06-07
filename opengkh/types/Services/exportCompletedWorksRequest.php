<?php

namespace gisgkh\types\Services;

/**
 * Экспорт сведений о выполненных работах и услугах
 */
class exportCompletedWorksRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Ссылка на период отчётности о выполненных работах
     * @var string[] $reportingPeriodGuid
     */
    public $reportingPeriodGuid;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
