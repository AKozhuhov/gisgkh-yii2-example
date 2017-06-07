<?php

namespace gisgkh\types\Services;

/**
 * Основные сведения по перечню работ/услуг
 */
class WorkingListBaseType
{
    /**
     * Идентификатор перечня
     * @var string $WorkListGUID
     */
    public $WorkListGUID;

    /**
     * Глобальный уникальный идентификатор дома по ФИАС
     * @var string $FIASHouseGuid
     */
    public $FIASHouseGuid;

    /**
     * Период "с"
     * @var \gisgkh\types\Services\WorkingListBaseType\MonthYearFrom $MonthYearFrom
     */
    public $MonthYearFrom;

    /**
     * Период "по"
     * @var \gisgkh\types\Services\WorkingListBaseType\MonthYearTo $MonthYearTo
     */
    public $MonthYearTo;

    /**
     * Идентификатор договора управления ГИС ЖКХ 
     * @var string $ContractGUID
     */
    public $ContractGUID;
}
