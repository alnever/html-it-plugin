<?php
/*
 * Abstract converter class
 * It implements common method, but don't realize a conevrtion process
 * @link
 * @since 1.0
 *
 * @package html-it-plugin
 * @subpackage html-it-plugin/admin
*/

namespace ContentConverter\Frontend;


abstract class Abstract_Converter implements Content_Converter_Interface {


	public function __construct() {
		add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
		add_action('wp_enqueue_scripts',array($this,'enqueue_styles'));
		$this->create_shortcode();
	}

	
	/*
	* The method implements a shortcode functionality
	* The method should be redeclared within the child class
	*/
	abstract public function shortcode($atts, $content, $tag);

	/*
	* The metod implements the transformation of the content
	* The method will be overriden by child classes or
	* via specific traits
	*/

	abstract protected function transform($content);


	/*
	* The method implements a convertion of the content
	* @param content - content to show
	* @param atts - additional atributes
	* @param alt - alternative text and title
	*/
	public function convert($content, $atts, $alt) {
		$slug  = $this->getSlug();
		$slug_ = str_replace("-","_",$slug);
		$content = do_shortcode($content);

		return sprintf(
			'<div class="%s">
				<div class="%s_header">
					<a id="%s_link" name="%s_link">
						<img src="%s" id="%s_img" name="%s_img" alt="%s" title="%s" />
					</a>
				</div>
				<div id="%s_source" name="%s_source">%s</div>
				<div class="result" id="%s_result" name="%s_result">%s</div>
			</div>',
			$slug_, // main CSS-class name
            $slug_, // header style
			$slug_, $slug_, // ID and name of the link
			sprintf("%simg/%s.png", plugin_dir_url(__FILE__), $slug), // image source file
			$slug_, $slug_, // image ID and name - for JS
			$alt, $alt, // Alternative text and Title/hint of the image
			$slug_, $slug_, // ID and name of the content (source) div (for JS)
			$content, // content (source)
			$slug_, $slug_, // ID, and name of the result div (for JS)
			$this->transform($content) // Transformed content - the result of the convertion
			//, $slug_, $slug_ // ID and name of the link
		);
	}

	/*
	* The method implements an injection of CSS
	*/
	public function enqueue_styles() {
		wp_enqueue_style(
			sprintf("%s-css", $this->getSlug()),
			sprintf("%scss/%s.css", plugin_dir_url(__FILE__), $this->getSlug()),
			null, null, 'all'
		);
	}

	/*
	* The method implements an injection of JavaScripts
	*/
	public function enqueue_scripts() {
		wp_enqueue_script(
			sprintf("%s-script", $this->getSlug()),
			sprintf("%sjs/%s.js", plugin_dir_url(__FILE__), $this->getSlug()),
			array("jquery"),
			false, false
		);
	}

	/*
	* The method creates a short code
	*/
	public function create_shortcode() {
		add_shortcode($this->getSlug(),array($this,'shortcode'));
	}

	/*
	* Get short class name and convert it into file-name style
	*/

	protected function getSlug() {
		$parts = explode("\\", get_class($this));
		$slug = $parts[count($parts) - 1];
		$slug = strtolower($slug);
		$slug = str_replace("_", "-", $slug);
		return $slug;
	}
}
