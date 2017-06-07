<?php

namespace gisgkh\types\Services\HMServicesTarifsDocType;

/**
 * 
 * Вид ЖКУ = "Коммунальные ресурсы"
 * Доступно организациям с полномочием:
 * - Орган исполнительной власти субъекта РФ в области регулирования тарифов
 * - Федеральная антимонопольная служба (Федеральная служба по тарифам)
 * - Ресурсоснабжающая организация 
 */
class KU
{
    /**
     * Вид коммунального ресурса (НСИ №2)
     * @var \gisgkh\types\Services\HMServicesTarifsDocType\KU\MServiceType[] $MServiceType
     */
    public $MServiceType;
}
