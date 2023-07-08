<?php
    namespace FacioCMS\App;

    class Minifier {
        public static function End() {
            ob_end_flush();
        }

        public static function Start($cms) {
            ob_start(function($buffer) use ($cms) {
                $search = [
                    '/\>[^\S ]+/s',
                    '/[^\S ]+\</s',
                    '/(\s)+/s',
                    '/<!--(.|\s)*?-->/'
                ];
                
                $replace = [
                    '>',
                    '<',
                    '\\1',
                    ''
                ];
                
                $buffer = preg_replace($search, $replace, $buffer);

                if(!$cms->IsInAdminPanel() && $cms->CachingEnabled()) $cms->CachePage($buffer);
                
                return $buffer;
            });
        }
    }