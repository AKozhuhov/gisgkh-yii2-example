<?php

namespace gisgkh\types\Services\importWorkingListRequest;

/**
 * Перечень утвержден
 */
class ApprovedWorkingListData extends \gisgkh\types\Services\WorkingListBaseType
{
    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;

    /**
     * Работа/услуга перечня 
     * @var \gisgkh\types\Services\importWorkingListRequest\ApprovedWorkingListData\WorkListItem[] $WorkListItem
     */
    public $WorkListItem;
}
