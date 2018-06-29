<?php
/*
 * HTML-converter class
 * @link
 * @since 1.0
 *
 * @package html-it-plugin
 * @subpackage html-it-plugin/admin
*/

namespace ContentConverter\Frontend;


class Html_Converter extends Abstract_Converter 
	implements Content_Converter_Interface 
{
	// use Trait as a decorator of the class
	// the Trait contains transform method to obtain a convertion result
	use Html_Converter_Trait;

	public function __construct() {
		parent::__construct();
	}

	/*
	* The method implements a shortcode functionality
	*/
	public function shortcode($atts, $content, $tag) {
		$atts = array_change_key_case((array)$atts, CASE_LOWER);
		$atts = shortcode_atts(
					array(),
					$atts
				);
		return $this->convert(do_shortcode($content), $atts, "Download HTML");
		
	}

}
