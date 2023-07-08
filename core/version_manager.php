<?php
    namespace FacioCMS\App;

    class VersionManager {
        public static function IsRegistred(string $_version) {
            $register = file_get_contents('../versions/versions.json');
            $versions = json_decode($register);

            foreach($versions as $version) {
                if($version->version === $_version) return true;
            }

            return false;
        }   

        public static function GetVersionConfigPath(string $_version) {
            $register = file_get_contents('../versions/versions.json');
            $versions = json_decode($register);

            foreach($versions as $version) {
                if($version->version === $_version) {
                    return $version->path;
                }
            }

            return "";
        }
    }