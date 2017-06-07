<?php

namespace gisgkh\types\Services\CompletedWorksByPeriodType;

/**
 * Создание нового акта
 */
class NewAct extends \gisgkh\types\Base\AttachmentType
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
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;
}
