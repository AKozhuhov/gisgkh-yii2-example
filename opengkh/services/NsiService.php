<?php

namespace gisgkh\services;

/**
 * 
 * Сервис экспорта общих справочников подсистемы НСИ
 * 
 * <code>
 * $configuration = [
 *   "wsdl" => "", // Путь к WSDL файлу сервиса [По-умолчанию, ../schemes/nsi-common/hcs-nsi-common-service.wsdl]
 *   "location" => "", // Расположение SOAP сервера [По-умолчанию, https://api.dom.gosuslugi.ru/ext-bus-nsi-common-service/services/NsiCommon]
 *   "senderId" => "", // Идентификатор поставщика данных
 *   "orgPPAGUID" => "", // Идентификатор зарегистрированной организации
 *   "sslCert" => "", // Путь к файлу SSL сертификата
 *   "sslKey" => "", // Путь к файлу ключа сертификата
 *   "caInfo" => "", // Расположение файла сертификата для авторизации на сервере ГИС ЖКХ
 *   "username" => "", // Имя пользователя для HTTP Basic авторизации
 *   "password" => "", // Пароль пользователя для HTTP Basic авторизации
 *   "debug_handle" => "" // Указатель ресурса для вывода отладочной информации (опционально)
 * ];
 * </code>
 * 
 * Параметр $configuration['location'] может быть
 * указан в виде массива:
 * 
 * <code>
 * $configuration['location'] = [
 *   'scheme' => 'https',
 *   'host' => 'api.dom.gosuslugi.ru',
 *   'port' => '',
 *   'user' => '',
 *   'pass' => '',
 *   'path' => '/ext-bus-nsi-common-service/services/NsiCommon',
 *   'query' => '',
 *   'fragment' => ''
 * ];
 * </code>
 * 
 * Указанные в этом массиве части, заменят соответствующие части
 * в URL сервиса, указанном по умолчанию
 */
class NsiService extends \gisgkh\ServiceBase
{
    /**
     * Расположение WSDL схемы
     * @var string $wsdl
     */
    protected $wsdl = __DIR__ . "/../schemes/nsi-common/hcs-nsi-common-service.wsdl";

    /**
     * Расположение SOAP сервера
     * @var string $location
     */
    protected $location = "https://api.dom.gosuslugi.ru/ext-bus-nsi-common-service/services/NsiCommon";

    /**
     * ВИ_НСИ_ППС. Получить перечень общесистемных справочников с указанием даты последнего изменения каждого из них.
     *
     * @param \gisgkh\types\NsiCommon\exportNsiListRequest $exportNsiListRequest Запрос получения перечня  общесистмного справочников.
     * @returns \gisgkh\types\NsiCommon\exportNsiListResult
     */
    public function exportNsiList(\gisgkh\types\NsiCommon\exportNsiListRequest $exportNsiListRequest)
    {
        $client = new \gisgkh\LocalSoapClient(
            $this->wsdl,
            $this->username,
            $this->password,
            $this->location,
            $this->sslCert,
            $this->sslKey,
            $this->caInfo,
            require __DIR__ . '/NsiService/exportNsiList.classmap.php',
            $this->debug_handle
        );
        
        $header = new \gisgkh\types\Base\ISRequestHeader();
        $header->MessageGUID = \gisgkh\Helper::guid();
        $header->Date = (new \DateTime())->format(\DateTime::ATOM);
        
        $client->__setSoapHeaders(new \SoapHeader("http://dom.gosuslugi.ru/schema/integration/base/", 'ISRequestHeader', $header));
        
        return $client->__soapCall('exportNsiList', [$exportNsiListRequest]);
    }

    /**
     * ВИ_НСИ_ПДС. Получить данные общесистемного справочника.
     *
     * @param \gisgkh\types\NsiCommon\exportNsiItemRequest $exportNsiItemRequest Запрос на получение данных общесистмного справочника.
     * @returns \gisgkh\types\NsiCommon\exportNsiItemResult
     */
    public function exportNsiItem(\gisgkh\types\NsiCommon\exportNsiItemRequest $exportNsiItemRequest)
    {
        $client = new \gisgkh\LocalSoapClient(
            $this->wsdl,
            $this->username,
            $this->password,
            $this->location,
            $this->sslCert,
            $this->sslKey,
            $this->caInfo,
            require __DIR__ . '/NsiService/exportNsiItem.classmap.php',
            $this->debug_handle
        );
        
        $header = new \gisgkh\types\Base\ISRequestHeader();
        $header->MessageGUID = \gisgkh\Helper::guid();
        $header->Date = (new \DateTime())->format(\DateTime::ATOM);
        
        $client->__setSoapHeaders(new \SoapHeader("http://dom.gosuslugi.ru/schema/integration/base/", 'ISRequestHeader', $header));
        
        return $client->__soapCall('exportNsiItem', [$exportNsiItemRequest]);
    }

    /**
     * ВИ_НСИ_ПДС_ПОСТР. Получить данные общесистемного справочника.
     *
     * @param \gisgkh\types\NsiCommon\exportNsiPagingItemRequest $exportNsiPagingItemRequest Запрос на получение данных общесистмного справочника.
     * @returns \gisgkh\types\NsiCommon\exportNsiPagingItemResult
     */
    public function exportNsiPagingItem(\gisgkh\types\NsiCommon\exportNsiPagingItemRequest $exportNsiPagingItemRequest)
    {
        $client = new \gisgkh\LocalSoapClient(
            $this->wsdl,
            $this->username,
            $this->password,
            $this->location,
            $this->sslCert,
            $this->sslKey,
            $this->caInfo,
            require __DIR__ . '/NsiService/exportNsiPagingItem.classmap.php',
            $this->debug_handle
        );
        
        $header = new \gisgkh\types\Base\ISRequestHeader();
        $header->MessageGUID = \gisgkh\Helper::guid();
        $header->Date = (new \DateTime())->format(\DateTime::ATOM);
        
        $client->__setSoapHeaders(new \SoapHeader("http://dom.gosuslugi.ru/schema/integration/base/", 'ISRequestHeader', $header));
        
        return $client->__soapCall('exportNsiPagingItem', [$exportNsiPagingItemRequest]);
    }
}
