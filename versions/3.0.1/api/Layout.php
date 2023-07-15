<?php
    namespace FacioCMS\Versions\v3\API;

    /**
     * @name Layout
     * Controller for Layouts
     */
    trait Layout {
        public function HandleAPI_CreateLayout() {
            global $database;

            header('Content-Type: application/json');

            // Preparing data
            $body = file_get_contents('php://input');
            $data = json_decode($body);
   
            $name = $data->name;

            // Creating layout
            $path = "../layouts/$name";

            if(file_exists($path . "/layout-definition.json")) return [ "error" => true, "content-message" => "Failed to craete layout!" ];
            
            mkdir($path);
            file_put_contents($path . "/layout-definition.json", '{
                "name": "' . $name . '",
                "version": "0.1.0",
                "requirements": {
                    "faciocms": {
                        "version": {
                            "min": "3.0.0",
                            "max": "unset"
                        }
                    }
                },
                "body": "body.php",
                "head": "head.php"
            }');
            file_put_contents($path . "/body.php", "");
            file_put_contents($path . "/head.php", "");

            return [ "error" => false, "content-message" => "Successfully created layout!" ];
        }

        public function HandleAPI_DeleteLayout() {
            global $database;

            header('Content-Type: application/json');

            // Preparing data
            $body = file_get_contents('php://input');
            $data = json_decode($body);
   
            $name = $data->name;

            $this->RecursiveDelete("../layouts/$name");

            return [ "error" => false, "content-message" => "Successfully deleted layout!" ];
        }
    }