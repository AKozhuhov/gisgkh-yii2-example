<?php

namespace gisgkh\types\Services;

/**
 * Базовый тип выполненной работы
 */
class CompletedWorkExportType
{
    /**
     * Фото выполненной работы/услуги
     * @var \gisgkh\types\Base\AttachmentType[] $photos
     */
    public $photos;

    /**
     * Количество выполненных работ
     * @var \gisgkh\types\Services\CompletedWorkExportType\MonthlyWork $MonthlyWork
     */
    public $MonthlyWork;

    /**
     * Описание работы в акте 
     * @var string $ActGUID
     */
    public $ActGUID;

    /**
     * Фактическая стоимость выполненных работ (если не была указана в плане)
     * @var integer $TotalCost
     */
    public $TotalCost;
}
