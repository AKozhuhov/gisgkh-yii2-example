<?php

namespace gisgkh\types\Services\CompletedWorkExportType;

/**
 * Количество выполненных работ
 */
class MonthlyWork
{
    /**
     * Количество работ
     * @var null $count
     */
    public $count;

    /**
     * Даты начала работ
     * @var \DateTime[] $WorkDate
     */
    public $WorkDate;
}
