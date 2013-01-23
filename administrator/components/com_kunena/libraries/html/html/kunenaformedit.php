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

		JFactory::getDocument()->addScriptDeclaration("
			(function($){
				$(document).ready(function ($){

					var defaults = {
						mode: 'inline',
						showbuttons: false,
						onblur: 'ignore',
						savenochange: true,
    					success: function() {
        					return false;
    					}
					};

					$.extend($.fn.editable.defaults, defaults);

					$('.editable').editable('disable');

	    			//enable / disable
					$('#enable').click(function() {
						if ($(this).hasClass('active')) {
							 $(this).removeClass('active');
						}
						else {
							 $(this).addClass('active');
						}
						$('.editable').editable('toggleDisabled');
					});
				});
			})(jQuery);
		");

		self::$loaded[__METHOD__] = true;

		return;
	}

	public static function text($i, $id, $selector, $inputClass, $text, $placeholder = null, $clear = true) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('a.$selector').editable({
						tpl: '<input type=\"text\" />',
						placeholder: '$placeholder',
						clear: '$clear',
						inputclass: '$inputClass'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" class="' .$selector. ' editable editable-disabled">' .$text. '</a>';

	}

	public static function textarea($i, $id, $selector, $inputClass, $text, $placeholder = null, $rows = 7) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('a.$selector').editable({
						tpl: '<textarea></textarea>',
						inputclass: '$inputClass'
						placeholder: '$placeholder',
						rows: '$rows'
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" class="' .$selector. ' editable editable-disabled">' .$text. '</a>';

	}

	public static function select($i, $id, $selector, $inputClass, $text, $array, $prepend = false, $sourceCache = true) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($){
					$(document).ready(function (){
						$('a.editable').click(function (e) {
							e.preventDefault();
							$(this).editable({
								type: 'select',
								tpl: '<select></select>',
								inputclass: '$inputClass',
								prepend: '$prepend',
								sourceCache: '$sourceCache'
							}).editable('show');
						});
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="#" class="' .$selector. ' editable editable-disabled">' .$text. '</a>';

	}

	public static function date($i, $id, $selector, $inputClass, $text, $format = 'yyyy/mm/dd', $viewFormat = null, $datePicker = null, $clear = false) {

		// Only load once
		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('a.$selector').click(function (e) {
						$(this).editable({
							tpl: '<div></div>',
							inputclass: '$inputClass',
							format: '$format',
							viewformat: '$viewFormat',
							datapicker: '$datePicker',
							clear: '$clear'
						}).editable('show');
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;
		}

		return '<a href="javascript: void(0);" class="' .$selector. ' editable editable-disabled">' .$text. '</a>';

	}

	public static function checklist($i, $id, $selector, $inputClass, $text, $separator, $source, $prepend, $sourceCache) {

		if (!isset(self::$loaded[__METHOD__][$selector]))
		{

			// Include Bootstrap framework
			self::init();

			// Attach the dropdown to the document
			JFactory::getDocument()->addScriptDeclaration(
				"(function($) {
					$('a.$selector').click(function (e) {
						$(this).editable({
							tpl: '<div></div>',
							inputclass: '$inputClass',
							sperator: '$separator',
							source: '$source',
							prepend: '$prepend',
							sourceCache: '$sourceCache'
						}).editable('show');
					});
				})(jQuery);"
			);

			self::$loaded[__METHOD__][$selector] = true;

		}

		return '<a href="javascript: void(0);" class="' .$selector. ' editable editable-disabled">' .$text. '</a>';

	}
}