<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип ответа на запрос создания, редактирования, удаления 
 */
class ResultType
{
    /**
     * Транспортный идентификатор, определенный постащиком информации
     * @var string $TransportGUID
     */
    public $TransportGUID;

    /**
     * Идентификатор объекта в ГИС ЖКХ
     * @var string $UpdateGUID
     */
    public $UpdateGUID;

    /**
     * Идентификатор объекта в ГИС ЖКХ
     * @var string $GUID
     */
    public $GUID;

    /**
     * Дата модификации
     * @var \DateTime $UpdateDate
     */
    public $UpdateDate;

    /**
     * Уникальный номер 
     * @var string $UniqueNumber
     */
    public $UniqueNumber;

    /**
     * Базовый тип ошибки контроля или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType[] $CreateOrUpdateError
     */
    public $CreateOrUpdateError;
}
