<?php

namespace gisgkh;

/**
 * Class Helper
 * @package gisgkh
 */
class Helper
{
    /**
     * Сгенерирует уникальный UUID
     *
     * @return string
     */
    public static function guid()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
          mt_rand(0, 65535),
          mt_rand(0, 65535),
          mt_rand(0, 65535),
          mt_rand(16384, 20479),
          mt_rand(32768, 49151),
          mt_rand(0, 65535),
          mt_rand(0, 65535),
          mt_rand(0, 65535));
    }

    /**
     * Вернёт ГОСТ94 хеш файла
     *
     * @param string $filename
     * @return string
     * @throws \Exception
     */
    public static function openssl($filename)
    {
        exec("openssl dgst -md_gost94 -r {$filename}", $output, $return);

        if ($return !== 0) {
            throw new \Exception("{$return}: {$output}");
        }

        return substr($output[0], 0, 64);
    }
}
