<?php

namespace gisgkh;

/**
 * Class LocalSoapClient
 * @package gisgkh
 */
class LocalSoapClient extends \SoapClient
{
    /**
     * Тело последнего запроса
     * @var string
     */
    public static $lastRequest = null;

    /**
     * Подготовленное к отправке тело последнего запроса
     * @var string
     */
    public static $lastPreparedRequest = null;

    /**
     * Заголовки последнего запроса
     * @var string
     */
    public static $lastRequestHeaders = null;

    /**
     * Тело последнего ответа
     * @var string
     */
    public static $lastResponse = null;

    /**
     * Заголовки последнего ответа
     * @var string
     */
    public static $lastResponseHeaders = null;

    /**
     * Путь к файлу SSL сертификата
     * @var string $sslCert
     */
    private $sslCert = null;

    /**
     * Путь к файлу ключа сертификата
     * @var string $sslKey
     */
    private $sslKey = null;

    /**
     * Расположение файла сертификата для авторизации на сервере ГИС ЖКХ
     * @var string $caInfo
     */
    private $caInfo = null;

    /**
     * Имя пользователя для HTTP Basic авторизации
     * @var string $username
     */
    private $username = null;

    /**
     * Пароль пользователя для HTTP Basic авторизации
     * @var string $password
     */
    private $password = null;

    /**
     * Указатель ресурса для вывода отладочной
     * информации
     * @var resource
     */
    private $debug_handle = null;

    /**
     * LocalSoapClient constructor.
     * @param string $wsdl
     * @param null $username
     * @param null $password
     * @param null $sslCert
     * @param null $sslKey
     * @param null $caInfo
     * @param string $location
     * @param array $classmap
     * @param resource $debug_handle
     */
    public function __construct(
        $wsdl,
        $username = null,
        $password = null,
        $location = null,
        $sslCert = null,
        $sslKey = null,
        $caInfo = null,
        $classmap = [],
        $debug_handle = null
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->sslCert = $sslCert;
        $this->sslKey = $sslKey;
        $this->caInfo = $caInfo;
        $this->debug_handle = $debug_handle;

        parent::__construct($wsdl, [
            'cache_wsdl'        => WSDL_CACHE_NONE,
            'soap_version'      => SOAP_1_1,
            'location'          => $location,
            'trace'             => true,
            'local_cert'        => $this->sslCert,
            'login'             => $this->username,
            'password'          => $this->password,
            'authentication'    => SOAP_AUTHENTICATION_DIGEST,
            'features'          => SOAP_SINGLE_ELEMENT_ARRAYS,
            'classmap'          => $classmap
        ]);
    }

    /**
     * Перегрузка системного метода выполнения запроса
     *
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int $version
     * @param int $one_way
     * @return mixed
     * @throws \SoapFault
     */
    public function __doRequest($request, $location, $action, $version, $one_way = 0)
    {
        self::$lastRequest = $this->prettify($request);

        // подготовка данных отправке (подпись и т.п.)
        $preparedRequest = $this->prepareRequestData($request);

        self::$lastPreparedRequest = $this->prettify($preparedRequest);

        if (is_resource($this->debug_handle)) {
            $timestamp = date("Y/m/d H:i:s");
            fwrite($this->debug_handle, "[{$timestamp}]" . self::$lastPreparedRequest . "\n\n");
        }

        $handle = curl_init($location);

        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_URL, $location);
        curl_setopt($handle, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml", "SOAPAction: {$action}"));
        curl_setopt($handle, CURLOPT_POSTFIELDS, $preparedRequest);
        curl_setopt($handle, CURLOPT_USERPWD, "{$this->username}:{$this->password}");
        curl_setopt($handle, CURLOPT_SSLCERT, $this->sslCert);
        curl_setopt($handle, CURLOPT_SSLKEY, $this->sslKey);
        curl_setopt($handle, CURLOPT_CAINFO, $this->caInfo);

        if (strpos($location, 'https://api.dom.gosuslugi.ru') === 0) {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
        } else {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($handle, CURLINFO_HEADER_OUT, true);

        $response = curl_exec($handle);

        self::$lastRequestHeaders = $this->__getLastRequestHeaders();

        self::$lastResponse = $this->prettify($response);
        self::$lastResponseHeaders = $this->__getLastResponseHeaders();

        if (is_resource($this->debug_handle)) {
            $timestamp = date("Y/m/d H:i:s");
            fwrite($this->debug_handle, "[{$timestamp}] " . self::$lastResponse . "\n\n");
        }

        if (empty($response)) {
            $errno = curl_errno($handle);
            $error = curl_error($handle);
            throw new \SoapFault((string) $errno, "CURL error: {$error}");
        }

        curl_close($handle);

        return $response;
    }

    /**
     * Подписывает запрос с помощью openssl
     *
     * @param string $data
     * @return string
     */
    protected function prepareRequestData($data)
    {
        $func_dgst = function($input, $sslKey = null) {
            $descriptors = [
                ['pipe', 'r'],
                ['pipe', 'w'],
                ['pipe', 'w']
            ];

            $process = proc_open("openssl dgst" . (empty($sslKey) ? '' : " -sign {$sslKey}") . " -binary -md_gost94", $descriptors, $pipes);

            $output = '';
            $errors = '';
            $returns = '';

            if (is_resource($process)) {

                fwrite($pipes[0], $input);
                fclose($pipes[0]);

                $output = stream_get_contents($pipes[1]);
                fclose($pipes[1]);

                $errors = stream_get_contents($pipes[2]);
                fclose($pipes[2]);

                $returns = proc_close($process);
            }

            if ($returns !== 0) {
                throw new \SoapFault($returns, $errors);
            }

            return base64_encode($output);
        };

        $func_loadCert = function($sslKey) {
            $data = str_replace(["\n", "\r"], '', file_get_contents($sslKey));

            $head = '-----BEGIN CERTIFICATE-----';
            $tail = '-----END CERTIFICATE-----';

            $start = strpos($data, $head) + strlen($head);
            $length = strpos($data, $tail) - $start;

            return substr($data, $start, $length);
        };

        $func_getIssuer = function($sslKey) {
            $output = [];
            $returns = 0;

            exec("openssl x509 -noout -issuer -nameopt sep_multiline,utf8 -in {$sslKey}", $output, $returns);

            if ($returns !== 0) {
                throw new \SoapFault($returns, implode('\n', $output));
            }

            $result = [];

            for ($i = 1; $i < count($output); $i++) {
                list($key, $value) = explode("=", $output[$i]);

                if (!empty($value)) {
                    $key = trim(strtolower($key));
                    $value = str_replace(['"', ','], ['\\"', '\\,'], $value);

                    if ($key == 'emailaddress') {
                        $key = '1.2.840.113549.1.9.1';
                    }

                    $result[] = "{$key}={$value}";
                }
            }

            return implode(',', $result);
        };

        $func_getSerial = function($sslKey) {
            $output = [];
            $returns = 0;

            exec("openssl x509 -noout -serial -in {$sslKey}", $output, $returns);

            if ($returns !== 0) {
                throw new \SoapFault($returns, implode('\n', $output));
            }

            return gmp_strval(gmp_init(explode('=', $output[0])[1], 16));
        };

        $model = new \stdClass();
        $model->signature_id = Helper::guid();
        $model->signing_time = date('c');
        $model->x509_issuer_name = $func_getIssuer($this->sslKey);
        $model->x509_sn = $func_getSerial($this->sslKey);
        $model->x590_cert = null;
        $model->signed_id = null;
        $model->digest1 = null;
        $model->digest2 = null;
        $model->digest3 = '';
        $model->signature_value = '';

        $document = new \DOMDocument("1.0", "UTF-8");
        $document->formatOutput = true;
        $document->loadXML($data);

        $xpath = new \DOMXPath($document);
        $xpath->registerNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        $versions = $xpath->query('//*[@version]', $document->documentElement);

        foreach ($versions as $version) {
            /* @type \DOMElement $version */
            $version->setAttributeNS(
                'http://dom.gosuslugi.ru/schema/integration/base/',
                $document->lookupPrefix('http://dom.gosuslugi.ru/schema/integration/base/') . ':version',
                $version->getAttribute('version'));
            $version->removeAttribute('version');
        }

        $signElement = $xpath->query('//*[@Id]', $document->documentElement)->item(0);

        if (empty($signElement)) {
            return $document->documentElement->C14N(false);
        }

        $model->signed_id = $signElement->getAttribute('Id');
        $model->digest1 = $func_dgst($signElement->C14N(true));
        $model->x590_cert = $func_loadCert($this->sslKey);
        $model->digest2 = $func_dgst(base64_decode($model->x590_cert));

        $xades = preg_replace_callback(
            '/\{(\w+)\}/',
            function($matches) use ($model) { return $model->{$matches[1]}; },
            '<ds:Signature xmlns:ds="http://www.w3.org/2000/09/xmldsig#" Id="xmldsig-{signature_id}"><ds:SignedInfo><ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/><ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr34102001-gostr3411"/><ds:Reference Id="xmldsig-{signature_id}-ref0" URI="#{signed_id}"><ds:Transforms><ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/><ds:Transform Algorithm="http://www.w3.org/2001/10/xml-exc-c14n#"/></ds:Transforms><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>{digest1}</ds:DigestValue></ds:Reference><ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#xmldsig-{signature_id}-signedprops"><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>{digest3}</ds:DigestValue></ds:Reference></ds:SignedInfo><ds:SignatureValue Id="xmldsig-{signature_id}-sigvalue">{signature_value}</ds:SignatureValue><ds:KeyInfo xmlns:ds="http://www.w3.org/2000/09/xmldsig#"><ds:X509Data><ds:X509Certificate>{x590_cert}</ds:X509Certificate></ds:X509Data></ds:KeyInfo><ds:Object><xades:QualifyingProperties xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" Target="#xmldsig-{signature_id}"><xades:SignedProperties Id="xmldsig-{signature_id}-signedprops"><xades:SignedSignatureProperties><xades:SigningTime>{signing_time}</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#gostr3411"/><ds:DigestValue>{digest2}</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>{x509_issuer_name}</ds:X509IssuerName><ds:X509SerialNumber>{x509_sn}</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate></xades:SignedSignatureProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object></ds:Signature>'
        );

        $xadeDocument = new \DOMDocument();
        $xadeDocument->loadXML($xades);

        $xadeElement = $document->importNode($xadeDocument->documentElement, true);
        $signElement->insertBefore($xadeElement, $signElement->childNodes->item(0));

        $signProp = $xpath->query("//xades:SignedProperties[@Id=\"xmldsig-{$model->signature_id}-signedprops\"]", $xadeElement)->item(0);
        $el = $xpath->query("//ds:SignedInfo/ds:Reference[@URI=\"#xmldsig-{$model->signature_id}-signedprops\"]/ds:DigestValue", $xadeElement)->item(0);
        $el->textContent = $func_dgst($signProp->C14N(false));

        $signedInfo = $xpath->query('//ds:SignedInfo', $xadeElement)->item(0);
        $el = $xpath->query('//ds:SignatureValue', $xadeElement)->item(0);
        $el->textContent = $func_dgst($signedInfo->C14N(false), $this->sslKey);

        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" . $document->documentElement->C14N(false);
    }

    protected function prettify($data)
    {
        // XML
        if (is_string($data) && class_exists("\\DOMDocument") && strpos(trim($data), "<?xml ") === 0) {
            $domDocument = new \DOMDocument("1.0", "UTF-8");
            $domDocument->preserveWhiteSpace = false;
            $domDocument->formatOutput = true;
            $domDocument->loadXML($data);
            $data = $domDocument->saveXML();
        }

        // HTML
        if (is_string($data) && is_callable("tidy_repair_string") &&
            (strpos(strtolower(trim($data)), "<!DOCTYPE ") === 0 || strpos(strtolower(trim($data)), "<html>") === 0)) {
            $data = tidy_repair_string($data, ['indent' => true, 'output-xhtml' => true], 'utf8');
        }

        return $data;
    }
}
