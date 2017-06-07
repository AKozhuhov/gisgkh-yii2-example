<?php

namespace gisgkh\types\Services\importWorkingListRequest;

/**
 * Идентификатор отмененного перечня
 */
class CancelWorkingList
{
    /**
     * Транспортный идентификатор
     * @var string $TransportGUID
     */
    public $TransportGUID;

    /**
     * Идентификатор перечня
     * @var string $WorkListGUID
     */
    public $WorkListGUID;
}
