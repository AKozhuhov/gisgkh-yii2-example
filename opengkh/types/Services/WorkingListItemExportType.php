<?php

namespace gisgkh\types\Services;

/**
 * Работа/услуга в перечне
 */
class WorkingListItemExportType
{
    /**
     * Цена
     * @var integer $Price
     */
    public $Price;

    /**
     * Объём
     * @var integer $Amount
     */
    public $Amount;

    /**
     * Общая стоимость
     * @var integer $TotalCost
     */
    public $TotalCost;

    /**
     * Количество
     * @var integer $Count
     */
    public $Count;
}
