<?php

namespace Vjencaonica;

use Twig_Extension;
use Twig_SimpleFunction;
use Exception;

/**
 * Class Vjencaonica_Twig_Extension_Image
 * @package Vjencaonica
 */
class Vjencaonica_Twig_Extension_Image extends Twig_Extension {

	/**
	 * Get functions.
	 *
	 * @return array|Twig_SimpleFunction[]
	 */
	public function getFunctions() {
		return [
			new Twig_SimpleFunction( 'image', [ $this, 'get_images_path' ] ),
		];
	}

	/**
	 * Get images path.
	 *
	 * @param $path
	 *
	 * @return string
	 * @throws Exception
	 */
	public function get_images_path($path) {

		// Image path
		$image_path = get_template_directory().'/assets/images/'.$path;

		// If file not exists
		if ( ! file_exists( $image_path ) ) {
			throw new Exception( 'Image does not exit!' );
		}

		// Image url
		$image_url = get_template_directory_uri().'/assets/images/'.$path;

		// Returns image url
		return $image_url;
	}

}