<?php
    namespace FacioCMS\Versions\v3_0_0\App;
    use FacioCMS\App\App;
    use FacioCMS\App\Minifier;
    use FacioCMS\Versions\v3_0_0\App\Source\Caching;
    use FacioCMS\Versions\v3_0_0\App\Source\Auth;
    use FacioCMS\Versions\v3_0_0\App\Source\View;   
    use FacioCMS\Versions\v3_0_0\App\Source\Lang; 
    use FacioCMS\Versions\v3_0_0\App\Source\Error;
    use FacioCMS\Versions\v3_0_0\App\Source\Install;
    use FacioCMS\Versions\v3_0_0\App\Source\Component;
    use FacioCMS\Versions\v3_0_0\App\Source\Page;
    use FacioCMS\Versions\v3_0_0\App\Source\Layout;
    use FacioCMS\Versions\v3_0_0\App\Source\Utils;
    use FacioCMS\Versions\v3_0_0\App\Source\Settings;
    use FacioCMS\Versions\v3_0_0\App\Source\User;
    use FacioCMS\Versions\v3_0_0\App\Source\Gallery;
    use FacioCMS\Versions\v3_0_0\App\Source\PluginLoader;
    use FacioCMS\Versions\v3_0_0\API\ApplicationProgrammingInterface;

    class FacioCMS_v3_0_0_App extends App {
        use Caching;
        use Auth;
        use View;
        use Lang;
        use Error;
        use Install;
        use ApplicationProgrammingInterface;
        use Component;
        use Page;
        use Layout;
        use Utils;
        use Settings;
        use User;
        use Gallery;
        use PluginLoader;

        /**
         * CMS Version downloaded from `fcms_coreconfig` table
         */
        public string $generator_version = "Uninitialized";

        /**
         * Authenticated user
         */
        public $user;

        /**
         * Page id which we're viewing
         */
        public $current_page_id = -1;

        /**
         * This method runs when application get requested
         */
        protected function Init() {
            global $version;
            $this->generator_version = $version;

            // Headers
            $this->SetDefaultHeaders();

            // Handling request
            $this->HandleRequestIfIsAPI();

            // Checking if it's installed
            $this->InstallCheck();

            // Minifing
            if($this->IsProduction()) Minifier::Start($this);

            // Getting the user & Initializing it
            $this->user = $this->GetUser();
            $this->InitUserAtCMS();

            // Initializing app
            $this->CheckIfIsInAdminPanel();

            if(!$this->IsInAdminPanel() && $this->CachingEnabled()) {
                $this->LoadCachedPage();
            }
        }

        /**
         * This method is invoked when FacioCMS generates head
         */
        public function FetchHead() {
            if($this->IsInAdminPanel()) echo "<title>FacioCMS - Admin Panel</title>";
        }

        /**
         * This methods set default headers for response
         */
        public function SetDefaultHeaders() {
            header("FacioCMS: $this->generator_version");
        }

        /**
         * For debugging
         */
        public function DebugLog(string $log): void {
            echo "<!-- DEBUG LOG: $log -->";
        }
    }

    // Initializing CMS Application
    $cms = $app = new FacioCMS_v3_0_0_App;