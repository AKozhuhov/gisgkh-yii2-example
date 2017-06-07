<?php

namespace gisgkh\types\NsiCommon;

/**
 * Возврат статуса отправленного сообщения
 */
class getStateResult extends \gisgkh\types\Base\BaseAsyncResponseType
{
    /**
     * Описание ошибок контролей или бизнес-процесса
     * @var \gisgkh\types\Base\ErrorMessageType $ErrorMessage
     */
    public $ErrorMessage;

    /**
     * Данные справочника.
     * @var \gisgkh\types\NsiBase\NsiItemType $NsiItem
     */
    public $NsiItem;

    /**
     * Данные справочника.
     * @var \gisgkh\types\NsiCommon\getStateResult\NsiPagingItem $NsiPagingItem
     */
    public $NsiPagingItem;

    /**
     * Перечень справочников с датой последнего изменения каждого из них.
     * @var \gisgkh\types\NsiBase\NsiListType $NsiList
     */
    public $NsiList;

    /**
     * [READ ONLY] Версия элемента, начиная с которой поддерживается совместимость
     * @var string $version
     */
    public $version = "10.0.1.2";
}
