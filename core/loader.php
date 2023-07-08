<?php
    namespace FacioCMS\Loader;

    require_once('requires.php');

    $config = \FacioCMS\Loader\Config\LoadBasicConfig();
    $database = \FacioCMS\Loader\Database\SQL::Connect($config->database);

    // Checking if database has default tables:
    // + fcms_coreconfig
    if(!$database->HasDefault()) {
        // If don't have then initializing them

        $database->CreateDefault();
    }

    // Core Config is ready
    // We can initialize selected FacioCMS Version
    $version = $database->Select('SELECT `version` FROM `fcms_coreconfig` LIMIT 1')[0]['version'];

    // As we got the version
    // We can run it
    $app = \FacioCMS\App\App::Create($version);