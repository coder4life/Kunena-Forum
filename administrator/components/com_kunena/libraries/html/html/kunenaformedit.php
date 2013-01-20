<?php
/**
 * Kunena Component
 * @package Kunena.Framework
 * @subpackage HTML
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

abstract class JHtmlKunenaFormedit {

	/**
	 * @var    array  Array containing information for loaded files
	 * @since  3.0
	 */
	protected static $loaded = array();

	/**
	 * Method to initialize the XEditable Cascading Style Sheet and JavaScript components into the document head.
	 *
	 * @param   mixed  $debug  Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public static function init($debug = null)
	{
		// Only load once
		if (!empty(self::$loaded[__METHOD__]))
		{
			return;
		}

		// Load Bootstrap
		JHtml::_('bootstrap.framework');

		// If no debugging value is set, use the configuration setting
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug  = (boolean) $config->get('debug');
		}

		JHtml::_('stylesheet', 'media/kunena/css/bootstrap-editable.css');
		JHtml::_('script', 'media/kunena/js/bootstrap-editable.min.js');

		JFactory::getDocument()->addScriptDeclaration("");

		self::$loaded[__METHOD__] = true;

		return;
	}

	public static function text($selector, $inputClass, $text, $placeholder = null, $clear = true) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('#$selector').editable({
						tpl: '<input type=\"text\" />',
						placeholder: '$placeholder',
						clear: '$clear',
						inputclass: '$inputClass'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" id="' . $selector . '" class="editable editable-click">' .$text. '</a>';

	}

	public static function textarea($selector, $inputClass, $text, $placeholder = null, $rows = 7) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('#$selector').editable({
						tpl: '<textarea></textarea>',
						inputclass: '$inputClass'
						placeholder: '$placeholder',
						rows: '$rows'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" d="' . $selector . '" class="editable editable-click">' .$text. '</a>';

	}

	public static function select($selector, $inputClass, $text, $array, $prepend = false, $sourceCache = true) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($){
					$('#$selector').editable({
						type: 'select',
						tpl: '<select></select>',
						inputclass: '$inputClass',
						source: '$array',
						prepend: '$prepend',
						sourceCache: '$sourceCache'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" id="' . $selector . '" class="editable editable-click">' .$text. '</a>';

	}

	public static function date($selector, $inputClass, $text, $format = 'yyyy/mm/dd', $viewFormat = null, $datePicker = null, $clear = false) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('#$selector').editable({
						tpl: '<div></div>',
						inputclass: '$inputClass',
						format: '$format',
						viewformat: '$viewFormat',
						datapicker: '$datePicker',
						clear: '$clear'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;
		}

		return '<a href="#" id="' . $selector . '" class="editable editable-click">' .$text. '</a>';

	}

	public static function checklist($selector, $inputClass, $text, $separator, $source, $prepend, $sourceCache) {

		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('#$selector').editable({
						tpl: '<div></div>',
						inputclass: '$inputClass',
						sperator: '$separator',
						source: '$source',
						prepend: '$prepend',
						sourceCache: '$sourceCache
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" id="' . $selector . '" class="editable editable-click">' .$text. '</a>';

	}
}