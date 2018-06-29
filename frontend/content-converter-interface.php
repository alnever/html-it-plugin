<?php
/*
 * Convertor class interface
 * @link
 * @since 1.0
 *
 * @package html-it-plugin
 * @subpackage html-it-plugin/admin
*/

namespace ContentConverter\Frontend;

/*
* Interface for all possible content converters
*/
interface Content_Converter_Interface {

	/*
	* The method implements a shortcode functionality
	*/
	public function shortcode($atts, $content, $tag);

	/*
	* The method implements a convertion of the content
	* @param content - content to show
	* @param atts - additional atributes
	* @param alt - alternative text and title
	*/
	public function convert($content, $atts, $alt);

	/*
	* The method implements an injection of CSS
	*/
	public function enqueue_styles();

	/*
	* The method implements an injection of JavaScripts
	*/
	public function enqueue_scripts();

	/*
	* The method creates a short code
	*/
	public function create_shortcode();

}