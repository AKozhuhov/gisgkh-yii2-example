<?php

namespace gisgkh\types\Base;

/**
 * Базовый тип заголовка
 */
class HeaderType
{
    /**
     * Дата отправки пакета
     * @var \DateTime $Date
     */
    public $Date;

    /**
     * Идентификатор сообщения
     * @var string $MessageGUID
     */
    public $MessageGUID;
}
