<?php
    namespace FacioCMS;

    use FacioCMS\App\TimeReport;
    use FacioCMS\App\Minifier;

    define('FACIOCMS_START', microtime(true) * 1000);
    session_start();

    /* ====================== */
    // Loading FacioCMS       //
    /* ====================== */
    require_once('../core/loader.php');
    
    /* ====================== */
    // Closing FacioCMS       //
    /* ====================== */
    Minifier::End();
    $database->CloseConnection();

    /* ====================== */
    // Time Report            //
    /* ====================== */
    TimeReport::Create();