<?php
    namespace FacioCMS\Loader\Config;

    function LoadBasicConfig($pre = ""): \stdClass {
        $configJSON = file_get_contents($pre . '../config.json');
        $config = json_decode($configJSON);

        return $config;
    }