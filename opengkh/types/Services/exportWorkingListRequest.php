<?php

namespace gisgkh\types\Services;

/**
 * Экспорт автоматически формируемого черновика с перечнем работ и услуг поставщика данных
 */
class exportWorkingListRequest extends \gisgkh\types\Base\BaseType
{
    /**
     * Период "с"
     * @var \gisgkh\types\Services\exportWorkingListRequest\MonthYearFrom $MonthYearFrom
     */
    public $MonthYearFrom;

    /**
     * Период "с"
     * @var \gisgkh\types\Services\exportWorkingListRequest\MonthYearTo $MonthYearTo
     */
    public $MonthYearTo;

    /**
     * Статус: (A)PPROVED - Утверждён (C)ANCELLED - Отменён
     * @var string $WorkListStatus
     */
    public $WorkListStatus;

    /**
     * Глобальный уникальный идентификатор дома по ФИАС
     * @var string $FIASHouseGuid
     */
    public $FIASHouseGuid;

    /**
     * Идентификатор перечня
     * @var string[] $WorkListGUID
     */
    public $WorkListGUID;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "11.1.0.8";
}
