<?php
/**
 * Created by PhpStorm.
 * User: Mateo Mlikota
 * Date: 7. 2. 2021.
 * Time: 17:13
 */

namespace Vjencaonica;

use WP_Post;

/**
 * Class Recipe_Dto
 * @package VegetaBio
 */
class Music_Band_Dto {	
	public static $PHONE 				= 'band_phone';
	public static $EMAIL 				= 'band_email';
	public static $CITY 				= 'band_city';
	public static $COUNTRY 				= 'band_country';
	public static $AVAILABLE_LOCATIONS	= 'band_available_locations';
	public static $MEMBERS 				= 'band_members';
	public static $INSTRUMENTS 			= 'band_instruments';
	public static $VIDEO_LINK 			= 'band_videolink';
	public static $GENRES 				= 'band_genres';
	public static $FEMALE_VOCAL 		= 'band_female_vocal';
	public static $MALE_VOCAL 			= 'band_male_vocal';
	public static $WEBSITE 				= 'band_website';
	public static $INSTAGRAM 			= 'band_instagram';
	public static $FACEBOOK 			= 'band_facebook';
	public static $TAGS 				= 'band_tags';
	public static $YEAR_OF_FOUNDATION 	= 'band_year_of_foundation';
	public static $GRANTED 				= 'band_granted';
	//BAND_NAME will be saved as post_title
	//SHORT_DESCRIPTION will be saved as post_excerpt

	public $id;
	public $bandName;
	public $shortDescription;
	public $phone;
	public $email;
	public $city;
	public $country;
	public $availableLocations;
	public $members;	
	public $instruments;
	public $videoLink;
	public $genres;
	public $femaleVocal;
	public $maleVocal;
	public $website;
	public $instagram;
	public $facebook;
	public $tags;
	public $yearOfFoundation;
	public $granted;

	/**
	 * Recipe_Dto constructor.
	 *
	 * @param WP_Post $wp_post
	 */
	public function __construct( WP_Post $wp_post ) {
		$this->id					= $wp_post->ID;
		$this->bandName				= $wp_post->post_title;
		$this->shortDescription		= $wp_post->post_excerpt;
		$this->content				= apply_filters( 'the_content', $wp_post->post_content );
		$this->phone				= update_field( self::$PHONE, $wp_post->ID );
		$this->email				= update_field( self::$EMAIL, $wp_post->ID );
		$this->city					= update_field( self::$CITY, $wp_post->ID );
		$this->country				= update_field( self::$COUNTRY, $wp_post->ID );
		$this->availableLocations	= update_field( self::$AVAILABLE_LOCATIONS, $wp_post->ID );
		$this->members	    		= update_field( self::$MEMBERS, $wp_post->ID );
		$this->instruments	    	= update_field( self::$INSTRUMENTS, $wp_post->ID );
		$this->videoLink	    	= update_field( self::$VIDEO_LINK, $wp_post->ID );
		$this->genres	    		= update_field( self::$GENRES, $wp_post->ID );
		$this->femaleVocal	   		= update_field( self::$FEMALE_VOCAL, $wp_post->ID );
		$this->maleVocal	   		= update_field( self::$MALE_VOCAL, $wp_post->ID );
		$this->website	    		= update_field( self::$WEBSITE, $wp_post->ID );
		$this->instagram	   		= update_field( self::$INSTAGRAM, $wp_post->ID );
		$this->facebook	    		= update_field( self::$FACEBOOK, $wp_post->ID );
		$this->tags	    			= update_field( self::$TAGS, $wp_post->ID );
		$this->yearOfFoundation	   	= update_field( self::$YEAR_OF_FOUNDATION, $wp_post->ID );
		$this->granted	    		= update_field( self::$GRANTED, $wp_post->ID );
	}
}