<?php

namespace gisgkh\types\Services;

/**
 * План по перечню работ/услуг
 */
class WorkingPlanType
{
    /**
     * Идентификатор перечня работ/услуг
     * @var string $WorkListGUID
     */
    public $WorkListGUID;

    /**
     * Год
     * @var null $Year
     */
    public $Year;

    /**
     * План по работе/услуге
     * @var \gisgkh\types\Services\WorkingPlanType\WorkPlanItem[] $WorkPlanItem
     */
    public $WorkPlanItem;

    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;
}
