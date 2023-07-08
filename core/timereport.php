<?php
    namespace FacioCMS\App;

    define("FACIOCMS_MAX_ROUTE_REPORTS", 250);

    class TimeReport {
        public static function Create(): void {
            // Time Report
            $faciocms_process_time = microtime(true) * 1000 - FACIOCMS_START;
    
            $loads_text = file_exists("../temp/performance/loads.json") ? file_get_contents("../temp/performance/loads.json") : "{}";
            $loads = json_decode($loads_text);
            
            if(isset($loads->{$_SERVER["REQUEST_URI"]})) {
                $loads->{$_SERVER["REQUEST_URI"]}[] = round($faciocms_process_time);
                $count = count($loads->{$_SERVER["REQUEST_URI"]});
                
                if($count > FACIOCMS_MAX_ROUTE_REPORTS) {
                    $diff = $count - FACIOCMS_MAX_ROUTE_REPORTS;

                    for($i = 0; $i < $diff; $i++) array_shift($loads->{$_SERVER["REQUEST_URI"]});
                }
            }
            else {
                $loads->{$_SERVER["REQUEST_URI"]} = [ round($faciocms_process_time) ];
            }
            
            file_put_contents("../temp/performance/loads.json", json_encode($loads));

            // Entry
            if(@$_GET["count-views"] === 'false' || str_starts_with($_SERVER["REQUEST_URI"], "/admin")) return;

            $date_ymd = date('Y-m-d');
            $date = date('Y-m-d H:i:s');

            $entries_text = file_exists("../temp/performance/entries.json") ? file_get_contents("../temp/performance/entries.json") : "{}";
            $entries = json_decode($entries_text);

            $data = [ "time" => $date, "path" => $_SERVER["REQUEST_URI"], "client-address" => $_SERVER["REMOTE_ADDR"] ];

            if(isset($entries->{$date_ymd})) $entries->{$date_ymd}[] = $data;
            else $entries->{$date_ymd} = [ $data ];

            file_put_contents("../temp/performance/entries.json", json_encode($entries));
        }
    }