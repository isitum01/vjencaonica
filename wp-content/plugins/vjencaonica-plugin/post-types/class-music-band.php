<?php

namespace Vjencaonica;

/**
 * Class Dual_Campaign_Registration
 * @package Vjencaonica
 */

class Music_Band {
	const POST_TYPE = 'music-band';

	public $id;
	public $wp_post;
	public $band_name;
	public $phone;
	public $email;
	public $city;
	public $country;
	public $availability;
	public $members;
	public $instruments;
	public $video_link;
	public $genres;
	public $female_vocal;
	public $male_vocal;
	public $website;
	public $instagram;
	public $facebook;
	public $tags;
	public $year_of_foundation;
	public $description;
	public $granted;
	public $date_created;

	/**
	 * NN_Blagdanska_Registration constructor.
	 *
	 * @param array $row
	 * @param null|\WP_Post $wp_post
	 */
	public function __construct( $row = [], $wp_post = null ) {
		$this->wp_post = $wp_post;
		$this->id      = ! empty( $wp_post ) ? $this->wp_post->ID : 0;

		if ( ! $row ) {
			return;
		}

		$this->band_name 			= $row['band_name'];
		$this->phone      			= $row['phone'];
		$this->email      			= $row['email'];
		$this->city  				= $row['city'];  //city
		$this->country    			= $row['country'];
		$this->available_locations  = $row['available_locations'];
		$this->members    			= $row['members'];
		$this->instruments      	= $row['instruments'];
		$this->video_link   		= $row['video_link'];
		$this->genres				= $row['genres'];
		$this->female_vocal			= $row['female_vocal'];
		$this->male_vocal			= $row['male_vocal'];
		$this->website				= $row['website'];
		$this->instagram			= $row['instagram'];
		$this->facebook				= $row['facebook'];
		$this->tags					= $row['tags'];
		$this->year_of_foundation	= $row['year_of_foundation'];
		$this->description			= $row['description'];
		$this->granted				= $row['granted'];
		$this->date_created    		= \DateTime::createFromFormat( DATE_ATOM, $row['date_created'] );

	}

	/**
	 * Load class
	 *
	 * @param VjencaonicaPlugin_Loader $loader
	 */
	public static function load_class( $loader ) {

		// Inits new post type
		$loader->add_action( 'init', static::class, 'init_post_type' );

	}

	/**
	 * Register meat the expert custom post type
	 */
	public static function init_post_type() {
		$labels = [
			'name'               => _x( 'Bendovi', 'post type general name', PLUGIN_TEXTDOMAIN ),
			'singular_name'      => _x( 'Bend', 'post type singular name', PLUGIN_TEXTDOMAIN ),
			'menu_name'          => _x( 'Bendovi', 'admin menu', PLUGIN_TEXTDOMAIN ),
			'name_admin_bar'     => _x( 'Bendovi', 'add new on admin bar', PLUGIN_TEXTDOMAIN ),
			'add_new'            => _x( 'Dodaj novi', self::POST_TYPE, PLUGIN_TEXTDOMAIN ),
			'add_new_item'       => __( 'Dodaj novi', PLUGIN_TEXTDOMAIN ),
			'new_item'           => __( 'Nova bend', PLUGIN_TEXTDOMAIN ),
			'edit_item'          => __( 'Uredi bend', PLUGIN_TEXTDOMAIN ),
			'view_item'          => __( 'Pregledaj bend', PLUGIN_TEXTDOMAIN ),
			'all_items'          => __( 'Svi bendovi', PLUGIN_TEXTDOMAIN ),
			'search_items'       => __( 'Pretraži bend', PLUGIN_TEXTDOMAIN ),
			'parent_item_colon'  => __( 'Parent objava:', PLUGIN_TEXTDOMAIN ),
			'not_found'          => __( 'Nije pronađeno', PLUGIN_TEXTDOMAIN ),
			'not_found_in_trash' => __( 'Nije pronađeno u smeću', PLUGIN_TEXTDOMAIN )
		];

		// Args
		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => __( 'music-band', PLUGIN_TEXTDOMAIN ) ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => [
				'title',
				'excerpt',
				'thumbnail'
			],
			'show_in_rest'       => false,
			'menu_icon'          => 'dashicons-groups'
		];

		// Register post type
		register_post_type( static::POST_TYPE, $args );
	}
}