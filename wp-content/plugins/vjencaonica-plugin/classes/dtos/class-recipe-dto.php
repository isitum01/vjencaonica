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
class Recipe_Dto {	
	public static $TIME = 'recipe_time';
	public static $PEOPLE = 'recipe_people';
	public static $LEVEL = 'recipe_level';
	public static $TIP = 'recipe_tip';
	// public static $FP_FEATURED_RECIPE = 'featured_recipe';

	/**
	 * @var string
	*/
	public $id;
	/*
	 * @var string
	*/
	public $title;
	/*
	 * @var string
	*/
	public $content;
	/*
	 * @var string
	*/
	public $excerpt;
	/*
	 * @var false|string
	*/
	public $featuredImage;
	/*
	 * @var string
	 */	
	public $time;
	/*
	 * @var string
	 */	
	public $people;
	/*
	 * @var string
	 */	
	public $level;
	/*
	 * @var string
	 **/	
	public $tip;

	/**
	 * Recipe_Dto constructor.
	 *
	 * @param WP_Post $wp_post
	 */
	public function __construct( WP_Post $wp_post ) {
		$this->id				= $wp_post->ID;
		$this->title			= $wp_post->post_title;
		$this->excerpt			= $wp_post->post_excerpt;
		$this->content			= apply_filters( 'the_content', $wp_post->post_content );
		$this->featuredImage	= get_the_post_thumbnail_url( $wp_post->ID );
		$this->time				= get_field( self::$TIME, $wp_post->ID );
		$this->people			= get_field( self::$PEOPLE, $wp_post->ID );
		$this->level			= get_field( self::$LEVEL, $wp_post->ID );
		$this->tip				= get_field( self::$TIP, $wp_post->ID );
		$this->tip	    		= update_field(self::$TIP, 'tip updated', $wp_post->ID);
	}
}