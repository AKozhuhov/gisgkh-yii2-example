<?php

namespace gisgkh\types\Base;

/**
 * Запрос статуса отправленного сообщения
 */
class getStateRequest
{
    /**
     * Идентификатор сообщения, присвоенный ГИС ЖКХ
     * @var string $MessageGUID
     */
    public $MessageGUID;
}
