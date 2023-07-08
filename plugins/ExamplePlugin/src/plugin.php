<?php
    namespace FacioCMS\Plugins\ExamplePlugin;

    use FacioCMS\Plugins\FacioCMSPlugin;

    class ExamplePlugin extends FacioCMSPlugin\Plugin {
        use FacioCMSPlugin\Performance;
        use FacioCMSPlugin\Component;

        /**
         * Fires when cms generates response for user
         */
        public function OnEnable(FacioCMSPlugin\EnablePluginEvent $event): void {
            $this->cms->DebugLog("Example Plugin enabled!");
        }

        /**
         * Fires after cms generate all response for user.
         */
        public function OnDisable(FacioCMSPlugin\DisablePluginEvent $event): void {
            // Plugin Destructor

            $this->cms->DebugLog("Example Plugin disabled");
        }

        public function OnClientResponseGenerating(FacioCMSPlugin\ClientResponseGeneratingEvent $event): void {
            $this->cms = $this->cms;

            switch ($event->state) {
                case FacioCMSPlugin\ClientResponseGeneratingEvent::$BEGINNING:
                    // Topbar etc (before includes body.php from layout)
                    break;
                case FacioCMSPlugin\ClientResponseGeneratingEvent::$ENDING:
                    // Footer etc (after includes body.php from layout)

                    // if($this->cms->IsInAdminPanel()) $this->IncludeComponent('AdminFooter');
                    break;
            }
        }
    }