<?php
    namespace FacioCMS\Versions\v3_0_0\App\Source;

    /**
     * @name View
     * Provides methods for view templating
     */
    trait View {
        private function IncludeView(string $path, array $data): void {
            global $cms;
            global $app;

            // Parsing data
            foreach($data as $key => $item) {
                eval("$$key = \$item;");
            }

            // Including view
            if(@include($path)) { /* Success */}
            else {
                echo 'Error while including view: ' . $path;
            }
        }
        
        public function View(string $viewName, array $data): void {
            global $cms;
            global $app;
            
            // if($this->isInAdminPanel()) {
                $this->IncludeView(realpath(dirname(__FILE__)) . '\\..\\views\\' . $viewName . '.php', $data);
            // }

        }
    }