<?php
/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 *
 */

/**
 * Created by PhpStorm.
 * User: buddha
 * Date: 14.09.2017
 * Time: 17:16
 *
 * @todo change base class back to BaseObject after v1.3 is stable
 */

namespace humhub\modules\calendar\interfaces;


use humhub\widgets\Label;
use Yii;
use \DateTime;
use yii\base\Component;
use yii\helpers\Html;

class CalendarItemWrapper extends Component implements CalendarItem
{
    const OPTION_START = 'start';
    const OPTION_END = 'end';
    const OPTION_TITLE = 'title';
    const OPTION_COLOR = 'color';
    const OPTION_ALL_DAY = 'allDay';
    const OPTION_UPDATE_URL = 'updateUrl';
    const OPTION_VIEW_URL = 'viewUrl';
    const OPTION_VIEW_MODE = 'viewMode';
    const OPTION_OPEN_URL = 'openUrl';
    const OPTION_ICON = 'icon';
    const OPTION_BADGE = 'badge';
    const OPTION_EDITABLE = 'editable';
    const OPTION_TIMEZONE = 'timezone';
    const OPTION_UID = 'uid';
    const OPTION_EXPORTABLE = 'exportable';
    const OPTION_RRULE = 'rrule';
    const OPTION_EXDATE = 'exdate';
    const OPTION_LOCATION = 'location';
    const OPTION_DESCRIPTION = 'description';

    /**
     * @var CalendarItemType
     */
    public $itemType;

    /**
     * @var array
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function getFullCalendarArray()
    {
        return [
            'uid' => $this->getUid(),
            'title' => $this->getTitle(),
            'editable' => $this->isEditable(),
            'backgroundColor' => Html::encode($this->getColor()),
            'allDay' => $this->isAllDay(),
            'updateUrl' => $this->getUpdateUrl(),
            'viewUrl' => $this->getViewUrl(),
            'viewMode' => $this->getViewMode(),
            'rrule' => $this->getRrule(),
            'exdate' => $this->getExdate(),
            'icon' => $this->getIcon(),
            'start' => Yii::$app->formatter->asDatetime($this->getStartDateTime(), 'php:c'),
            'end' => Yii::$app->formatter->asDatetime($this->getEndDateTime(), 'php:c'),
            'eventDurationEditable' => true,
            'eventStartEditable' => true
        ];
    }

    /**
     * @inheritdoc
     */
    public function getStartDateTime()
    {
        return $this->getOption(static::OPTION_START, new DateTime());
    }

    /**
     * @inheritdoc
     */
    public function getEndDateTime()
    {
        return $this->getOption(static::OPTION_END, new DateTime());
    }

    /**
     * @inheritdoc
     */
    public function getTimezone()
    {
        return $this->getOption(static::OPTION_TIMEZONE, Yii::$app->timeZone);
    }

    public function isEditable()
    {
        return $this->getOption(static::OPTION_EDITABLE, false);
    }

    public function getTitle()
    {
        return $this->getOption(static::OPTION_TITLE, $this->itemType ? $this->itemType->getTitle() : '');
    }

    public function getRrule()
    {
        return $this->getOption(static::OPTION_RRULE, null);
    }

    public function getExdate()
    {
        return $this->getOption(static::OPTION_EXDATE, null);
    }

    public function getColor()
    {
        return $this->getOption(static::OPTION_COLOR, $this->itemType ? $this->itemType->getColor() : '');
    }

    public function isAllDay()
    {
        if($this->getOption(static::OPTION_ALL_DAY, $this->itemType ? $this->itemType->isAllDay() : null)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUpdateUrl()
    {
        return $this->getOption(static::OPTION_UPDATE_URL, null);
    }

    protected function getViewMode()
    {
        return $this->getOption(static::OPTION_VIEW_MODE, static::VIEW_MODE_MODAL);
    }

    protected function getViewUrl()
    {
        return $this->getOption(static::OPTION_VIEW_URL, null);
    }

    protected function getOption($key, $default, $options = null)
    {
        $options = (empty($options)) ? $this->options : $options;
        return isset($options[$key]) ? $options[$key] : $default;
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->getOption(static::OPTION_OPEN_URL, null);
    }

    /**
     * @inheritdoc
     */
    public function getBadge()
    {
        $default = $this->itemType ? Label::asColor($this->getColor(), $this->itemType->getTitle())->icon($this->getIcon())->right() : '';
        return $this->getOption(static::OPTION_BADGE, $default);
    }

    /**
     * @inheritdoc
     */
    public function getIcon()
    {
        return $this->getOption(static::OPTION_ICON, $this->itemType ? $this->itemType->getIcon() : null);
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->getOption(static::OPTION_UID, null);
    }

    /**
     * @return boolean
     */
    public function isExportable()
    {
        return $this->getOption(static::OPTION_EXPORTABLE, true);
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->getOption(static::OPTION_LOCATION, true);
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getOption(static::OPTION_DESCRIPTION, true);
    }
}