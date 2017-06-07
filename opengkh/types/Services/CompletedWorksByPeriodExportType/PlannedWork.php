<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodExportType;

/**
 * Выполненная плановая работа/услуга
 */
class PlannedWork extends \gisgkh\types\Services\CompletedWorkExportType
{
    /**
     * Идентификатор работы/услуги перечня 
     * @var string $WorkPlanItemGUID
     */
    public $WorkPlanItemGUID;

    /**
     * Количество работ по плану
     * @var null $plannedCount
     */
    public $plannedCount;
}
