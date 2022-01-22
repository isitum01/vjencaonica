<?php

namespace Vjencaonica;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class Vjencaonica_Twig_Extension_Localization
 * @package Vjencaonica
 */
class Vjencaonica_Twig_Extension_Localization extends Twig_Extension {

	/**
	 * Get functions
	 *
	 * @return array|Twig_SimpleFunction[]
	 */
	public function getFunctions() {
		return [
			new Twig_SimpleFunction( 'translate', [ $this, 'localization' ] ),
		];
	}

	/**
	 * Return translated version of passed string depending on current page language
	 *
	 * @param $string
	 */
	public function localization( $string ) {
		_e( $string, 'vjencaonica-theme' );
	}
}