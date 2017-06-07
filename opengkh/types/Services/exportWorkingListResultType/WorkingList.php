<?php

namespace gisgkh\types\Services\exportWorkingListResultType;

/**
 * Перечень работ/услуг
 */
class WorkingList extends \gisgkh\types\Services\WorkingListBaseType
{
    /**
     * Дата модификации объекта
     * @var \DateTime $ModificationDate
     */
    public $ModificationDate;

    /**
     * Статус: (A)PPROVED - Утверждён (C)ANCELLED - Отменён
     * @var string $WorkListStatus
     */
    public $WorkListStatus;

    /**
     * Работа/услуга перечня 
     * @var \gisgkh\types\Services\exportWorkingListResultType\WorkingList\WorkListItem[] $WorkListItem
     */
    public $WorkListItem;
}
