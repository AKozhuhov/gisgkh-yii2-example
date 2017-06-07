<?php

return [
    "opengkh" => [
        "location" => [
            "host" => "217.107.108.147:10081"
        ],
        "sslCert" => __DIR__ . "/keys/rgd.pem",
        "sslKey" => __DIR__ . "/keys/rgd.pem",
        "caInfo" => __DIR__ . "/keys/CA-SIT.pem",
        "username" => "sit",
        "password" => "rZ_GG72XS^Vf55ZW",
        "debug_handle" => fopen(__DIR__ . "/../runtime/opengkh.log", 'w'),
        "debug_path" => __DIR__ . "/../runtime/opengkh.log"
    ]
];