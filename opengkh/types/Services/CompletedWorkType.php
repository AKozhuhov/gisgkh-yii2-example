<?php

namespace gisgkh\types\Services;

/**
 * Базовый тип выполненной работы
 */
class CompletedWorkType
{
    /**
     * Фото выполненной работы/услуги
     * @var \gisgkh\types\Base\AttachmentType[] $photos
     */
    public $photos;

    /**
     * Количество выполненных работ
     * @var \gisgkh\types\Services\CompletedWorkType\MonthlyWork $MonthlyWork
     */
    public $MonthlyWork;

    /**
     * Описание работы в новом приложенном акте 
     * @var string $ActTransportGUID
     */
    public $ActTransportGUID;

    /**
     * Описание работы в ранее загруженном акте 
     * @var string $ActGUID
     */
    public $ActGUID;

    /**
     * Фактическая стоимость выполненных работ (если не была указана в плане)
     * @var integer $TotalCost
     */
    public $TotalCost;
}
