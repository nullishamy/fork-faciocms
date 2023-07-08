<?php
    namespace FacioCMS\Error;
    
    define('DATABASE_CONNECT_ERROR', 'FacioCMS failed to connect to database!');
    define('DATABASE_QUERY_ERROR', 'FacioCMS MySQL query failed');
    define('VERSION_NOT_REGISTRED', 'FacioCMS Version is not registred in versions.json');
    define('VERSION_NOT_INSTALLED', 'FacioCMS Version is not installed');

    class ErrorHandler {
        public static function Throw(string $error, string $details): void {
            ob_end_clean();     // Clear previous echoes and errors / warnings 

            require_once('components/error.php');
            
            exit();
        }
    }