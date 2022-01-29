<?php

namespace Vjencaonica;

/**
 * Class Music_Band
 * @package Vjencaonica
 */
class Music_Band
{
	const POST_TYPE = 'music-band';
	const SLUG = 'music-band-prijave';

	public $id;
	// public $wp_post;
	public $band_name;
	public $phone;
	public $email;
	public $city;
	public $country;
	public $available_locations;
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
	public $short_description;
	public $granted;
	public $date_created;


	/**
	 * Music_Band constructor.
	 *
	 * @param array $row
	 * @param null $wp_post
	 */
	public function __construct($row = [], $post = null)
	{
		// Init current date as date created
		$this->date_created = new \DateTime();

		// We construct empty object
		if (empty($row)) {
			return;
		}

		$this->id 					= intval($row['id']);
		// public $wp_post;
		$this->band_name 			= $row['band_name'];
		$this->phone 				= $row['phone'];
		$this->email 				= $row['email'];
		$this->city 				= $row['city'];
		$this->country 				= $row['country'];
		$this->available_locations 	= $row['available_locations'];
		$this->members 				= $row['members'];
		$this->instruments 			= $row['instruments'];
		$this->video_link			= $row['video_link'];
		$this->genres 				= $row['genres'];
		$this->female_vocal			= $row['female_vocal'];
		$this->male_vocal 			= $row['male_vocal'];
		$this->website 				= $row['website'];
		$this->instagram 			= $row['instagram'];
		$this->facebook 			= $row['facebook'];
		$this->tags 				= $row['tags'];
		$this->year_of_foundation	= $row['year_of_foundation'];
		$this->short_description 	= $row['short_description'];
		$this->granted 				= $row['granted'];
		$this->date_created			= \DateTime::createFromFormat(DATE_ATOM, $row['date_created']);
		
	}

	/**
	 * Loads the class.
	 *
	 * @param $loader
	 */
	public static function load_class($loader)
	{
		// Initializes new post type
		$loader->add_action('init', static::class, 'init_post_type');
	}

	/**
	 * Registers Music Band custom post type.
	 */
	public static function init_post_type()
	{
		$labels = [
			'name'               => _x('Music bands', 'post type general name', PLUGIN_TEXTDOMAIN),
			'singular_name'      => _x('Music Band', 'post type singular name', PLUGIN_TEXTDOMAIN),
			'menu_name'          => _x('Music bands', 'admin menu', PLUGIN_TEXTDOMAIN),
			'name_admin_bar'     => _x('Music Band', 'add new on admin bar', PLUGIN_TEXTDOMAIN),
			'add_new'            => _x('Add New', 'book', PLUGIN_TEXTDOMAIN),
			'add_new_item'       => __('Add New Music Band', PLUGIN_TEXTDOMAIN),
			'new_item'           => __('New Music Band', PLUGIN_TEXTDOMAIN),
			'edit_item'          => __('Edit Music Band', PLUGIN_TEXTDOMAIN),
			'view_item'          => __('View Music Band', PLUGIN_TEXTDOMAIN),
			'all_items'          => __('All Music bands', PLUGIN_TEXTDOMAIN),
			'search_items'       => __('Search Music bands', PLUGIN_TEXTDOMAIN),
			'parent_item_colon'  => __('Parent Music bands:', PLUGIN_TEXTDOMAIN),
			'not_found'          => __('No registrations found.', PLUGIN_TEXTDOMAIN),
			'not_found_in_trash' => __('No registrations found in Trash.', PLUGIN_TEXTDOMAIN)
		];

		$args = [
			'labels'             => $labels,
			'description'        => __('Description.', PLUGIN_TEXTDOMAIN),
			'public'             => false,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => ['slug' => self::SLUG],
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => ['title', 'editor'],
			'menu_icon'          => 'dashicons-id-alt',
			'show_in_rest'       => false
		];

		// Register post type
		register_post_type(static::POST_TYPE, $args);
	}
}
