<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип ответа на запрос статуса
 */
class BaseAsyncResponseType extends \gisgkh\types\Base\BaseType
{
    /**
     * Статус обработки
     * @var string $RequestState
     */
    public $RequestState;

    /**
     * Идентификатор сообщения, присвоенный ГИС ЖКХ
     * @var string $MessageGUID
     */
    public $MessageGUID;
}
