<?php

namespace gisgkh\types\Services\WorkingPlanType;

/**
 * План по работе/услуге
 */
class WorkPlanItem
{
    /**
     * Идентификатор работы/услуги перечня 
     * @var string $WorkListItemGUID
     */
    public $WorkListItemGUID;

    /**
     * Месяц
     * @var null $Month
     */
    public $Month;

    /**
     * Год
     * @var null $Year
     */
    public $Year;

    /**
     * Даты начала работ по плану
     * @var \DateTime[] $WorkDate
     */
    public $WorkDate;

    /**
     * Количество работ
     * @var null $WorkCount
     */
    public $WorkCount;

    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;
}
