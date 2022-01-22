<?php

namespace Vjencaonica;

/**
 * Class Random_Values_Helper
 * @package Vjencaonica
 */
class Random_Values_Helper {
	/*
	 * @param int $length
	 *
	 * @return string
	 */
	public static function get_random_string( $length = 12 ) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charlen    = strlen( $characters );
		$str        = '';
		for ( $i = 0; $i < $length; $i ++ ) {
			$str .= $characters[ rand( 0, $charlen - 1 ) ];
		}

		return $str;
	}
}