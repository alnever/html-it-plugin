<?php
/*
 * Convertor factory
 * @link
 * @since 1.0
 *
 * @package html-it-plugin
 * @subpackage html-it-plugin/admin
*/

namespace ContentConverter\Frontend;

// The class realize creation of the content coverter object
// according the given class name
class Content_Converter_Factory {

	public static function getConverter($classname): Content_Converter_Interface {
		return new $classname;
	}

}