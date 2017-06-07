<?php

namespace gisgkh\types\Services;

/**
 * Выполненная работа за период
 */
class CompletedWorksByPeriodType
{
    /**
     * Ссылка на период отчётности о выполненных работах/услугах
     * @var string $reportingPeriodGuid
     */
    public $reportingPeriodGuid;

    /**
     * Выполненная плановая работа/услуга
     * @var \gisgkh\types\Services\CompletedWorksByPeriodType\PlannedWork[] $PlannedWork
     */
    public $PlannedWork;

    /**
     * Выполненная внеплановая работа/услуга
     * @var \gisgkh\types\Services\CompletedWorksByPeriodType\UnplannedWork[] $UnplannedWork
     */
    public $UnplannedWork;

    /**
     * Создание нового акта
     * @var \gisgkh\types\Services\CompletedWorksByPeriodType\NewAct $NewAct
     */
    public $NewAct;

    /**
     * Ссылка на ранее загруженный акт
     * @var \gisgkh\types\Services\CompletedWorksByPeriodType\ExistedAct $ExistedAct
     */
    public $ExistedAct;
}
