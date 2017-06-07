<?php

namespace gisgkh\types\Base;

/**
 * Результат выполнения C_UD
 */
class CommonResultType
{
    /**
     * Идентификатор создаваемой/изменяемой сущности
     * @var string $GUID
     */
    public $GUID;

    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;

    /**
     * Уникальный реестровый номер
     * @var string $UniqueNumber
     */
    public $UniqueNumber;

    /**
     * Дата модификации
     * @var \DateTime $UpdateDate
     */
    public $UpdateDate;

    /**
     * Описание ошибки
     * @var \gisgkh\types\Base\ErrorMessageType[] $Error
     */
    public $Error;
}
