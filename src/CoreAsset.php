<?php

namespace romeyk\fullcalendar;

use Yii;
use yii\web\AssetBundle;

/**
 * Class CoreAsset
 *
 * @author Roman Chuykov <mail@romeyk.org.ua>
 * @package romeyk\fullcalendar
 */
class CoreAsset extends AssetBundle
{
	/**
	 * @var string Location of the Fullcalendar files
	 */
	public $sourcePath = '@npm/fullcalendar';

	/**
	 * @var boolean Automatically generation the needed language js files.
	 */
	public $autoGenerate = true;

	/**
	 * @var array Required CSS files
	 */
	public $css = [
		'main.css',
	];

	/**]
	 * @var array Fullcalendar dependencies
	 */
	public $depends = [
		'yii\web\YiiAsset',
	];

	/**
	 * @var array Required JS files
	 */
	public $js = [
		'main.js',
		'locales-all.js',
	];

	/**
	 * @var null|string Fullcalendar language
	 */
	public $language = null;

	/**
	 * @inheritdoc
	 */
	public function registerAssetFiles($view)
	{
		$language = empty($this->language) ? Yii::$app->language : $this->language;
		if (file_exists($this->sourcePath . "/locales/$language.js")) {
			$this->js[] = "locales/$language.js";
		}

		return parent::registerAssetFiles($view);
	}
}