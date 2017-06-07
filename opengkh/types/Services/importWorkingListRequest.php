<?php

namespace gisgkh\types\Services;

/**
 * Импорт перечня работ и услуг на период
 */
class importWorkingListRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Перечень утвержден
     * @var \gisgkh\types\Services\importWorkingListRequest\ApprovedWorkingListData $ApprovedWorkingListData
     */
    public $ApprovedWorkingListData;

    /**
     * Идентификатор отмененного перечня
     * @var \gisgkh\types\Services\importWorkingListRequest\CancelWorkingList $CancelWorkingList
     */
    public $CancelWorkingList;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.1";
}
