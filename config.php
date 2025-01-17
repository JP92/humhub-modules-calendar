<?php

use humhub\components\Application;
use humhub\modules\space\widgets\Menu;
use humhub\modules\user\widgets\ProfileMenu;
use humhub\modules\space\widgets\Sidebar;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\widgets\TopMenu;

return [
    'id' => 'calendar',
    'class' => 'humhub\modules\calendar\Module',
    'namespace' => 'humhub\modules\calendar',
    'events' => [
        ['class' => Menu::class, 'event' => Menu::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onSpaceMenuInit']],
        ['class' => Application::class, 'event' => Application::EVENT_BEFORE_REQUEST, 'callback' => ['humhub\modules\calendar\Events', 'onBeforeRequest']],
        ['class' => ProfileMenu::class, 'event' => ProfileMenu::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onProfileMenuInit']],
        ['class' => Sidebar::class, 'event' => Sidebar::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onSpaceSidebarInit']],
        ['class' => ProfileSidebar::class, 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onProfileSidebarInit']],
        ['class' => humhub\modules\dashboard\widgets\Sidebar::class, 'event' => humhub\modules\dashboard\widgets\Sidebar::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onDashboardSidebarInit']],
        ['class' => TopMenu::class, 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\calendar\Events', 'onTopMenuInit']],
        ['class' => 'humhub\modules\calendar\interfaces\CalendarService', 'event' => 'getItemTypes', 'callback' => ['humhub\modules\calendar\Events', 'onGetCalendarItemTypes']],
        ['class' => 'humhub\modules\calendar\interfaces\CalendarService', 'event' => 'findItems', 'callback' => ['humhub\modules\calendar\Events', 'onFindCalendarItems']],
        ['class' => '\humhub\modules\content\widgets\WallEntryLinks', 'event' => 'init', 'callback' => ['humhub\modules\calendar\Events', 'onWallEntryLinks']],
    ],
];