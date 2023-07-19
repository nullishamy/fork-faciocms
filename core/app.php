<?php
    namespace FacioCMS\App;

    use FacioCMS\Error\ErrorHandler;
    use FacioCMS\Roles\Roles;

    class App {
        public function __construct($init = true) {
            if($init) $this->Init();
        }

        public static function Create(string $version) {

            if(\FacioCMS\App\VersionManager::IsRegistred($version)) {
                $versionConfigPath = '../' . \FacioCMS\App\VersionManager::GetVersionConfigPath($version);

                if(!file_exists($versionConfigPath)) {
                    ErrorHandler::Throw(
                        VERSION_NOT_INSTALLED,
                        "Version $version is not installed"
                    );
                }

                $versionConfigText = file_get_contents($versionConfigPath);
                $versionConfig = json_decode($versionConfigText);

                // This application class instance is created for loading app
                $appInstance_loadingInstance = new App(false);

                // Check if user is in Admin Panel
                $appInstance_loadingInstance->CheckIfIsInAdminPanel();
                if($appInstance_loadingInstance->IsInAdminPanel()) {
                    $appInstance_loadingInstance->LoadAdminPanel();
                }
                else {
                    define("FACIOCMS_IS_ADMINSITE", false);
                }

                unset($appInstance_loadingInstance);

                // Including FacioCMS Application Version libs
                require_once(str_replace("/version.json", "", $versionConfigPath) . '/' . $versionConfig->source_libs);

                // Including FacioCMS Application
                require_once(str_replace("/version.json", "", $versionConfigPath) . '/' . $versionConfig->logic);

                // Load plugins before generating response
                if($cms) $cms->LoadPlugins($cms);

                require_once('components/core-top.php');
                require_once(str_replace("/version.json", "", $versionConfigPath) . '/' . $versionConfig->head);
                echo "</head><body>";
                require_once(str_replace("/version.json", "", $versionConfigPath) . '/' . $versionConfig->body);
                require_once('components/core-bottom.php');

                // Unload plugins before generating response
                if($cms) $cms->UnloadPlugins();

                return;
            }

            ErrorHandler::Throw(
                VERSION_NOT_REGISTRED,
                "Version $version is not registred in versions.json"
            );
        }

        /**
         * @name isAdminPanel
         * @description Tells if user is in admin panel `/admin` directory
         * 
         */
        private bool $isAdminPanel = false;

        /**
         * @name userLevel
         * @description Tells user permissions etc
         * 
         * $userLevel = 0 - User is not logged.
         * $userLevel = 1 - User is logged. Viewer permissions
         * $userLevel = 2 - User is logged. Moderator permissions
         * $userLevel = 3 - User is logged. User is Admin
         * $userLevel = 4 - User is logged. User is Super Admin
         * 
         */
        private int $userLevel = 0;

        public function IsInAdminPanel(): bool {
            return $this->isAdminPanel;
        }

        public function IsUserLogged(): bool {
            return $this->userLevel > 0;
        }

        public function GetUserRole(): Roles {
            return $this->GetUserRoleByPermissionLevel($this->userLevel);
        }

        public function GetUserRoleByPermissionLevel(int $perm_level = 0) {
            switch($perm_level) {
                case 0:
                    return \FacioCMS\Roles\Roles::$NotAuthorized;
                case 1:
                    return \FacioCMS\Roles\Roles::$Viewer;
                case 2:
                    return \FacioCMS\Roles\Roles::$Moderator;
                case 3:
                    return \FacioCMS\Roles\Roles::$Admin;
                case 4:
                    return \FacioCMS\Roles\Roles::$SuperAdmin;
            }
        }

        public function GetUserPermissionLevelByRoleString(string $role) {
            switch($role) {
                case 'Viewer':
                    return 1;
                case 'Moderator':
                    return 2;
                case 'Admin':
                    return 3;
                case 'Super Admin':
                    return 4;
            }

            return 0;
        }

        public function CheckIfIsInAdminPanel(): void {
            $this->isAdminPanel = str_starts_with($_SERVER["REQUEST_URI"], '/admin');
        }

        public function LoadAdminPanel(): void {
            define("FACIOCMS_IS_ADMINSITE", true);
        }
    }
