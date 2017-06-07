<?php

namespace gisgkh\types\Services;

/**
 * Работа/услуга в перечне
 */
class WorkingListItemType
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
     * Количество
     * @var null $Count
     */
    public $Count;

    /**
     * Общая стоимость
     * @var integer $TotalCost
     */
    public $TotalCost;

    /**
     * Ссылка на работу/услугу организации (НСИ 59)
     * @var \gisgkh\types\NsiBase\nsiRef $WorkItemNSI
     */
    public $WorkItemNSI;

    /**
     * Номер строки в перечне работ и услуг
     * @var null $Index
     */
    public $Index;
}
