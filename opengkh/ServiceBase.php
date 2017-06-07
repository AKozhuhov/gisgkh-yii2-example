<?php


namespace gisgkh;


/**
 * Общий класс для всех сервисов
 */
abstract class ServiceBase
{
    /**
     * Расположение WSDL схемы
     * @var string $wsdl
     */
    protected $wsdl = null;

    /**
     * Расположение SOAP сервера
     * @var string $location
     */
    protected $location = null;

    /**
     * Идентификатор поставщика данных
     * @var string $senderId
     */
    protected $senderId = null;

    /**
     * Идентификатор зарегистрированной организации
     * @var string $orgPPAGUID
     */
    protected $orgPPAGUID = null;

    /**
     * Путь к файлу SSL сертификата
     * @var string $sslCert
     */
    protected $sslCert = null;

    /**
     * Путь к файлу ключа сертификата
     * @var string $sslKey
     */
    protected $sslKey = null;

    /**
     * Расположение файла сертификата для авторизации на сервере ГИС ЖКХ
     * @var string $caInfo
     */
    protected $caInfo = null;

    /**
     * Имя пользователя для HTTP Basic авторизации
     * @var string $username
     */
    protected $username = null;

    /**
     * Пароль пользователя для HTTP Basic авторизации
     * @var string $password
     */
    protected $password = null;

    /**
     * Указатель ресурса для вывода отладочной
     * информации
     * @var resource
     */
    protected $debug_handle = null;

    /**
     * FileService constructor.
     *
     * <code>
     * $configuration = [
     *   "location" => "", // Расположение SOAP сервера
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
     * 'scheme' => '', //
     * 'host' => '', //
     * 'port' => '', //
     * 'user' => '', //
     * 'pass' => '', //
     * 'path' => '', //
     * 'query' => '', //
     * 'fragment' => '' //
     * ];
     * </code>
     *
     * Указанные в этом массиве части, заменят соответствующие части
     * в URL сервиса, указанном по умолчанию
     *
     * @param array $configuration
     */
    public function __construct(array $configuration = [])
    {
        if (isset($configuration["location"])) {
            if (is_array($configuration["location"])) {
                $url = parse_url($this->location);
                if (is_array($url)) {
                    foreach ($configuration["location"] as $part => $value) {
                        if (key_exists($part, $url)) {
                            $this->location = str_replace($url[$part], $value, $this->location);
                        }
                    }
                }
            } else {
                $this->location = $configuration["location"];
            }
        }

        $this->senderId = @$configuration["senderId"] ?: $this->senderId;
        $this->orgPPAGUID = @$configuration["orgPPAGUID"] ?: $this->orgPPAGUID;
        $this->sslCert = @$configuration["sslCert"] ?: $this->sslCert;
        $this->sslKey = @$configuration["sslKey"] ?: $this->sslKey;
        $this->caInfo = @$configuration["caInfo"] ?: $this->caInfo;
        $this->username = @$configuration["username"] ?: $this->username;
        $this->password = @$configuration["password"] ?: $this->password;
        $this->debug_handle = @$configuration['debug_handle'] ?: $this->debug_handle;
    }

    /**
     * Вывод информации для отладки
     * @param string $message
     * @param string $eol
     */
    public function debug($message, $eol = PHP_EOL)
    {
        if (is_resource($this->debug_handle)) {
            $timestamp = date("Y/m/d H:i:s");
            fwrite($this->debug_handle, "[$timestamp] $message$eol");
        }
    }
}
