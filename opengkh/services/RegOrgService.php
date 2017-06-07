<?php

namespace gisgkh\services;

/**
 * 
 * 
 * 
 * <code>
 * $configuration = [
 *   "wsdl" => "", // Путь к WSDL файлу сервиса [По-умолчанию, ../schemes/organizations-registry-common/hcs-organizations-registry-common-service.wsdl]
 *   "location" => "", // Расположение SOAP сервера [По-умолчанию, https://api.dom.gosuslugi.ru/ext-bus-org-registry-common-service/services/OrgRegistryCommon]
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
 *   'path' => '/ext-bus-org-registry-common-service/services/OrgRegistryCommon',
 *   'query' => '',
 *   'fragment' => ''
 * ];
 * </code>
 * 
 * Указанные в этом массиве части, заменят соответствующие части
 * в URL сервиса, указанном по умолчанию
 */
class RegOrgService extends \gisgkh\ServiceBase
{
    /**
     * Расположение WSDL схемы
     * @var string $wsdl
     */
    protected $wsdl = __DIR__ . "/../schemes/organizations-registry-common/hcs-organizations-registry-common-service.wsdl";

    /**
     * Расположение SOAP сервера
     * @var string $location
     */
    protected $location = "https://api.dom.gosuslugi.ru/ext-bus-org-registry-common-service/services/OrgRegistryCommon";

    /**
     * экспорт сведений об организациях
     *
     * @param \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryRequest $exportOrgRegistryRequest Экспорт сведений из реестра организаций
     * @returns \gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryResult
     */
    public function exportOrgRegistry(\gisgkh\types\OrganizationsRegistryCommon\exportOrgRegistryRequest $exportOrgRegistryRequest)
    {
        $client = new \gisgkh\LocalSoapClient(
            $this->wsdl,
            $this->username,
            $this->password,
            $this->location,
            $this->sslCert,
            $this->sslKey,
            $this->caInfo,
            require __DIR__ . '/RegOrgService/exportOrgRegistry.classmap.php',
            $this->debug_handle
        );
        
        $header = new \gisgkh\types\Base\ISRequestHeader();
        $header->MessageGUID = \gisgkh\Helper::guid();
        $header->Date = (new \DateTime())->format(\DateTime::ATOM);
        
        $client->__setSoapHeaders(new \SoapHeader("http://dom.gosuslugi.ru/schema/integration/base/", 'ISRequestHeader', $header));
        
        return $client->__soapCall('exportOrgRegistry', [$exportOrgRegistryRequest]);
    }

    /**
     * экспорт сведений о поставщиках данных
     *
     * @param \gisgkh\types\OrganizationsRegistryCommon\exportDataProviderRequest $exportDataProviderRequest В качестве поискового параметра используется Идентификатор ИС из RequestHeader
     * @returns \gisgkh\types\OrganizationsRegistryCommon\exportDataProviderResult
     */
    public function exportDataProvider(\gisgkh\types\OrganizationsRegistryCommon\exportDataProviderRequest $exportDataProviderRequest)
    {
        $client = new \gisgkh\LocalSoapClient(
            $this->wsdl,
            $this->username,
            $this->password,
            $this->location,
            $this->sslCert,
            $this->sslKey,
            $this->caInfo,
            require __DIR__ . '/RegOrgService/exportDataProvider.classmap.php',
            $this->debug_handle
        );
        
        $header = new \gisgkh\types\Base\ISRequestHeader();
        $header->MessageGUID = \gisgkh\Helper::guid();
        $header->Date = (new \DateTime())->format(\DateTime::ATOM);
        
        $client->__setSoapHeaders(new \SoapHeader("http://dom.gosuslugi.ru/schema/integration/base/", 'ISRequestHeader', $header));
        
        return $client->__soapCall('exportDataProvider', [$exportDataProviderRequest]);
    }
}
