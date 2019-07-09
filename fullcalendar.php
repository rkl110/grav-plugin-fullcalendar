<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class FullcalendarPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }
        // Enable the main events we are interested in
        $this->enable([
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths',0]
        ]);
        //add assets
        $assets = $this->grav['assets'];
        $assets->addJs('plugin://fullcalendar/assets/lib/jquery.min.js');
        $assets->addJs('plugin://fullcalendar/assets/lib/moment.min.js');
        $assets->addJs('plugin://fullcalendar/assets/ical.js/build/ical.js');
        $assets->addJs('plugin://fullcalendar/assets/fullcalendar.js');
        $assets->addJs('plugin://fullcalendar/assets/dist/locale/de.js');
        $assets->addJs('plugin://fullcalendar/assets/monthpic.js');
        $assets->addCss('plugin://fullcalendar/assets/fullcalendar.css');
        $assets->addCss('plugin://fullcalendar/assets/custom.css');
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }
}
