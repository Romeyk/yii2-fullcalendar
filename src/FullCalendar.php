<?php

namespace romeyk\fullcalendar;

use romeyk\fullcalendar\models\Event;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/**
 * Class Fullcalendar
 *
 * @author Roman Chuykov <mail@romeyk.org.ua>
 * @package romeyk\fullcalendar
 */
class FullCalendar extends Widget
{
	/**
	 * @var array The fullcalendar options, for all available options check http://fullcalendar.io/docs/
	 */
	public $clientOptions = [
		'weekends' => true,
		'initialView'  => 'dayGridMonth',
		'editable' => false,
	];

	/**
	 * @var array|Event[]|string Array containing the events, can be JSON array,
	 * PHP array or URL that returns an array containing JSON events
	 */
	public $events = [];

	/**
	 * @var array
	 */
	public $headerToolbar = [
		'center' => 'title',
		'left'   => 'prev,today,next',
		'right'  => 'timeGridWeek,dayGridMonth',
	];

	/**
	 * @var string Text to display while the calendar is loading
	 */
	public $loading = 'Please wait, calendar is loading';

	/**
	 * @var array Default options for Fullcalendar tag
	 */
	public $options = [];

	/**
	 * Always make sure we have a valid id and class for the Fullcalendar widget
	 */
	public function init()
	{
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}

		if (!isset($this->options['class'])) {
			$this->options['class'] = 'fullcalendar';
		}

		parent::init();
	}

	/**
	 * Load the options and start the widget
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo Html::endTag('div') . "\n";

		$assets = CoreAsset::register($this->view);

		if (isset($this->clientOptions['locale'])) {
			$assets->language = $this->clientOptions['locale'];
		}

		$this->clientOptions['headerToolbar'] = $this->headerToolbar;

		$js = <<<JS
			var el = document.getElementById("{$this->options['id']}");
			var calendar = new FullCalendar.Calendar(el, {$this->getClientOptions()});
			calendar.render();
JS;
		$this->view->registerJs($js, View::POS_READY);
	}

	/**
	 * @return string
	 * Returns an JSON array containing the fullcalendar options,
	 * all available callbacks will be wrapped in JsExpressions objects if they're set
	 */
	private function getClientOptions()
	{
		$events = [];
		foreach ($this->events as $event) {
			$events[] = $event->getNotEmptyAttributes();
		}
		$options = ArrayHelper::merge(['events' => $events], $this->clientOptions);

		return Json::encode($options);
	}
}