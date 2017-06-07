<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodType\UnplannedWork;

/**
 * Аварийные работы (tns:UnplannedWork/workType/Code=3)
 */
class Accident
{
    /**
     * Ссылка на объект аварии (НСИ №57)
     * @var \gisgkh\types\NsiBase\nsiRef $accidentObjectKind
     */
    public $accidentObjectKind;

    /**
     * Причина аварии
     * @var string $accidentReason
     */
    public $accidentReason;

    /**
     * Вид КУ (НСИ 3) для объектов аварии: - Объект инженерной инфраструктуры - Объект коммунальной инфраструктуры
     * @var \gisgkh\types\NsiBase\nsiRef $MSType
     */
    public $MSType;

    /**
     * 
     * @var string $workType
     */
    public $workType;
}
