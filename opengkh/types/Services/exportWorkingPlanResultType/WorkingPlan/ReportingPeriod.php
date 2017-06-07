<?php

namespace gisgkh\types\Services\exportWorkingPlanResultType\WorkingPlan;

class ReportingPeriod
{
    /**
     * Ссылка на период отчётности о выполненных работах
     * @var string $reportingPeriodGuid
     */
    public $reportingPeriodGuid;

    /**
     * Год и месяц отчетного периода
     * @var \gisgkh\types\Services\exportWorkingPlanResultType\WorkingPlan\ReportingPeriod\MonthYear $MonthYear
     */
    public $MonthYear;

    /**
     * План по работе/услуге
     * @var \gisgkh\types\Services\exportWorkingPlanResultType\WorkingPlan\ReportingPeriod\WorkPlanItem[] $WorkPlanItem
     */
    public $WorkPlanItem;
}
