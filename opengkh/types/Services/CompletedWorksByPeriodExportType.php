<?php

namespace gisgkh\types\Services;

/**
 * Выполненная работа за период (для экспорта, без TransportGUID)
 */
class CompletedWorksByPeriodExportType
{
    /**
     * Ссылка на период отчётности о выполненных работах/услугах
     * @var string $reportingPeriodGuid
     */
    public $reportingPeriodGuid;

    /**
     * Выполненная плановая работа/услуга
     * @var \gisgkh\types\Services\CompletedWorksByPeriodExportType\PlannedWork[] $PlannedWork
     */
    public $PlannedWork;

    /**
     * Выполненная внеплановая работа/услуга
     * @var \gisgkh\types\Services\CompletedWorksByPeriodExportType\UnplannedWork[] $UnplannedWork
     */
    public $UnplannedWork;

    /**
     * Акт
     * @var \gisgkh\types\Services\CompletedWorksByPeriodExportType\Act[] $Act
     */
    public $Act;
}
