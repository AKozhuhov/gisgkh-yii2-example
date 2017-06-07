<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodExportType;

/**
 * Акт
 */
class Act extends \gisgkh\types\Base\AttachmentType
{
    /**
     * Дата
     * @var \DateTime $Date
     */
    public $Date;

    /**
     * Номер
     * @var string $Number
     */
    public $Number;

    /**
     * Номер договора
     * @var string $ContractNumber
     */
    public $ContractNumber;

    /**
     * Идентификатор акта
     * @var string $ActGUID
     */
    public $ActGUID;
}
