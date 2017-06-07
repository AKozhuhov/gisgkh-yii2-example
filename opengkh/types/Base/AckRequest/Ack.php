<?php

namespace gisgkh\types\Base\AckRequest;

/**
 * Квитанция
 */
class Ack
{
    /**
     * Идентификатор сообщения, присвоенный ГИС ЖКХ
     * @var string $MessageGUID
     */
    public $MessageGUID;

    /**
     * Идентификатор сообщения, присвоенный поставщиком
     * @var string $RequesterMessageGUID
     */
    public $RequesterMessageGUID;
}
