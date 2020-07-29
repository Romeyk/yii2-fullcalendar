<?php
namespace romeyk\fullcalendar\models;

use yii\base\Model;

/**
 * Class Event
 *
 * @author Roman Chuykov <mail@romeyk.org.ua>
 * @package romeyk\fullcalendar
 * @see https://fullcalendar.io/docs/event-parsing
 */
class Event extends Model
{
	/**
	 * @var string|int Will uniquely identify your event.
	 */
	public $id;

	/**
	 * @var string|int Events that share a groupId will be dragged and resized together automatically.
	 */
	public $groupId;

	/**
	 * @var bool Determines if the event is shown in the “all-day” section of the view, if applicable.
	 * Determines if time text is displayed in the event.
	 * If this value is not specified, it will be inferred by the start and end properties.
	 */
	public $allDay;

	/**
	 * @var string When your event begins.
	 * If your event is explicitly allDay, hour, minutes, seconds and milliseconds will be ignored.
	 */
	public $start;

	/**
	 * @var string When your event ends.
	 * If your event is explicitly allDay, hour, minutes, seconds and milliseconds will be ignored.
	 * If omitted, your events will appear to have the default duration.
	 */
	public $end;


	/**
	 * @var array The days of the week this event repeats.
	 * An array of integers representing days e.g. [0, 1] for an event that repeats on Sundays and Mondays.
	 */
	public $daysOfWeek;

	/**
	 * @var string The time of day the event starts.
	 */
	public $startTime;

	/**
	 * @var string The time of day the event ends.
	 */
	public $endTime;

	/**
	 * @var string When recurrences of the event start.
	 */
	public $startRecur;

	/**
	 * @var string When recurrences of the event end.
	 */
	public $endRecur;

	/**
	 * @var string The text that will appear on an event.
	 */
	public $title;

	/**
	 * @var string A URL that will be visited when this event is clicked by the user.
	 */
	public $url;

	/**
	 * @var string A single string like 'myclass', a space-separated string like 'myclass1 myclass2'.
	 * Determines which HTML classNames will be attached to the rendered event.
	 */
	public $className;

	/**
	 * @var array. An array of strings like [ 'myclass1', myclass2' ].
	 * Determines which HTML classNames will be attached to the rendered event.
	 */
	public $classNames;

	/**
	 * @var bool Overrides the master editable option for this single event.
	 */
	public $editable;

	/**
	 * @var bool Overrides the master eventStartEditable option for this single event.
	 */
	public $startEditable;

	/**
	 * @var bool Overrides the master eventDurationEditable option for this single event.
	 */
	public $durationEditable;

	/**
	 * @var bool Overrides the master eventResourceEditable option for this single event.
	 * Requires one of the resource plugins.
	 */
	public $resourceEditable;

	/**
	 * @var string The string ID of a Resource.
	 */
	public $resourceId;

	/**
	 * @var array An array of string IDs of Resources.
	 */
	public $resourceIds;

	/**
	 * @var string Allows alternate rendering of the event, like background events.
	 * Can be 'auto' (the default), 'block', 'list-item', 'background', 'inverse-background', or 'none'.
	 */
	public $display;

	/**
	 * @var bool Overrides the master eventOverlap option for this single event.
	 * If false, prevents this event from being dragged/resized over other events. A
	 * lso prevents other events from being dragged/resized over this event.
	 */
	public $overlap;

	/**
	 * @var string A groupId belonging to other events, "businessHours", or an object.
	 */
	public $constraint;

	/**
	 * @var string An alias for specifying the backgroundColor and borderColor at the same time.
	 */
	public $color;

	/**
	 * @var string Sets an event’s background color just like the calendar-wide eventBackgroundColor option.
	 */
	public $backgroundColor;

	/**
	 * @var string Sets an event’s border color just like the calendar-wide eventBorderColor option.
	 */
	public $borderColor;

	/**
	 * @var string Sets an event’s text color just like the calendar-wide eventTextColor option.
	 */
	public $textColor;

	/**
	 * @var array A plain object with any miscellaneous properties.
	 * It will be directly transferred to the extendedProps hash in each Event Object.
	 */
	public $extendedProps;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'groupId', 'start', 'end', 'daysOfWeek', 'startTime', 'endTime', 'startRecur', 'endRecur',
				'title', 'url', 'className', 'classNames', 'resourceId', 'resourceIds', 'display', 'constraint',
				'color', 'backgroundColor', 'borderColor', 'textColor', 'extendedProps'], 'safe'],
			[['allDay', 'editable', 'startEditable', 'durationEditable', 'resourceEditable', 'overlap'], 'boolean'],
		];
	}

	/**
	 * Returns not empty attributes
	 *
	 * @return array
	 */
	public function getNotEmptyAttributes()
	{
		$result = [];
		foreach ($this->attributes as $name => $attribute) {
			if ($attribute !== null) {
				$result[$name] = $attribute;
			}
		}

		return $result;
	}

}