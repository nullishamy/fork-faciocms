<?php   
    namespace FacioCMS;

    define('FACIOCMS_CONTENT_READ_IMPORT', false);

    class Includes {
        public static function StyleSheet(string $path) {
            // echo "<style included>".file_get_contents('../' . $path)."</style>";
            echo '<link rel="stylesheet" href="' . str_replace("public", "", $path) . '">';
        }

        public static function AdminIncludeStyleSheet(string $path, string $version = '3.0.0') {
            if(FACIOCMS_CONTENT_READ_IMPORT) echo '<style>' . file_get_contents('../' .$path) . '</style>';
            
            else echo '<link rel="stylesheet" href="/static/' . 
                str_replace(".", "_", str_replace("versions/$version/", "", $path)) . 
                '?version='.$version.'">';
        }

        public static function AdminIncludeScript(string $path, string $version = '3.0.0') {
            if(FACIOCMS_CONTENT_READ_IMPORT) echo '<script>' . file_get_contents('../' .$path) . '</script>';

            else echo '<script src="/static/' . 
                str_replace(".", "_", str_replace("versions/$version/", "", $path)) . 
                '?version='.$version.'"></script>';
        }
    }