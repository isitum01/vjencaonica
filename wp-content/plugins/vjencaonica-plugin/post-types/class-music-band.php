<?php

namespace Vjencaonica;

/**
 * Class Music_Band
 * @package Vjencaonica
 */
class Music_Band
{
	public static $POST_TYPE = 'music-band';
	public static $SLUG = 'music-band-prijave';

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
	public $wp_post;
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
	 * @param null|\WP_Post $wp_post
	 */
	public function __construct($row = [], $wp_post = null)
	{
		// Init current date as date created
		// $this->date_created = new \DateTime();

		// $this->wp_post = $wp_post;
		// $this->id = !empty($wp_post) ? $this->wp_post->ID : 0;

		// We construct empty object
		// if (empty($row)) {
		// 	return;
		// }

		if (empty($wp_post)) {
			throw new \Exception('No post in product constructor');
		}

		$this->id           	= $wp_post->ID;
		$this->title       		= $wp_post->post_title;
		$this->content     	 	= $wp_post->post_content;
		$this->excerpt      	= $wp_post->post_excerpt;
		$this->phone				= get_field( self::$PHONE, $wp_post->ID );
		$this->email				= get_field( self::$EMAIL, $wp_post->ID );
		$this->city					= get_field( self::$CITY, $wp_post->ID );
		$this->country				= get_field( self::$COUNTRY, $wp_post->ID );
		$this->availableLocations	= get_field( self::$AVAILABLE_LOCATIONS, $wp_post->ID );
		$this->members	    		= get_field( self::$MEMBERS, $wp_post->ID );
		$this->instruments	    	= get_field( self::$INSTRUMENTS, $wp_post->ID );
		$this->videoLink	    	= get_field( self::$VIDEO_LINK, $wp_post->ID );
		$this->genres	    		= get_field( self::$GENRES, $wp_post->ID );
		$this->femaleVocal	   		= get_field( self::$FEMALE_VOCAL, $wp_post->ID );
		$this->maleVocal	   		= get_field( self::$MALE_VOCAL, $wp_post->ID );
		$this->website	    		= get_field( self::$WEBSITE, $wp_post->ID );
		$this->instagram	   		= get_field( self::$INSTAGRAM, $wp_post->ID );
		$this->facebook	    		= get_field( self::$FACEBOOK, $wp_post->ID );
		$this->tags	    			= get_field( self::$TAGS, $wp_post->ID );
		$this->yearOfFoundation	   	= get_field( self::$YEAR_OF_FOUNDATION, $wp_post->ID );
		$this->granted	    		= get_field( self::$GRANTED, $wp_post->ID );

		// $this->id 					= intval($row['id']);
		// public $wp_post;
		// $this->band_name 			= $row['band_name'];
		// $this->phone 				= $row['phone'];
		// $this->email 				= $row['email'];
		// $this->city 				= $row['city'];
		// $this->country 				= $row['country'];
		// $this->available_locations 	= $row['available_locations'];
		// $this->members 				= $row['members'];
		// $this->instruments 			= $row['instruments'];
		// $this->video_link			= $row['video_link'];
		// $this->genres 				= $row['genres'];
		// $this->female_vocal			= $row['female_vocal'];
		// $this->male_vocal 			= $row['male_vocal'];
		// $this->website 				= $row['website'];
		// $this->instagram 			= $row['instagram'];
		// $this->facebook 			= $row['facebook'];
		// $this->tags 				= $row['tags'];
		// $this->year_of_foundation	= $row['year_of_foundation'];
		// $this->short_description 	= $row['short_description'];
		// $this->granted 				= $row['granted'];
		// $this->date_created			= \DateTime::createFromFormat(DATE_ATOM, $row['date_created']);
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

		// Create custom fields
		$loader->add_action('acf/init', static::class, 'music_band_add_local_field_groups');
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

		// Args
		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => self::$SLUG),
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => ['title', 'editor', 'excerpt', 'thumbnail'],
			'menu_icon'          => 'dashicons-id-alt',
			'show_in_rest'       => true
		];

		// Register post type
		register_post_type(static::$POST_TYPE, $args);
	}

	public static function music_band_add_local_field_groups()
	{
		acf_add_local_field_group(
			[
				'key'                   => 'group_music_band_info',
				'title'                 => __('Basic Info', PLUGIN_TEXTDOMAIN),
				'fields'                => array(
					array(
						'key'               => self::$PHONE,
						'label'             => __('Phone', PLUGIN_TEXTDOMAIN),
						'name'              => self::$PHONE,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$EMAIL,
						'label'             => __('E-mail', PLUGIN_TEXTDOMAIN),
						'name'              => self::$EMAIL,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$CITY,
						'label'             => __('City', PLUGIN_TEXTDOMAIN),
						'name'              => self::$CITY,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$COUNTRY,
						'label'             => __('Country', PLUGIN_TEXTDOMAIN),
						'name'              => self::$COUNTRY,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$AVAILABLE_LOCATIONS,
						'label'             => __('Available locations', PLUGIN_TEXTDOMAIN),
						'name'              => self::$AVAILABLE_LOCATIONS,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$MEMBERS,
						'label'             => __('Members', PLUGIN_TEXTDOMAIN),
						'name'              => self::$MEMBERS,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$INSTRUMENTS,
						'label'             => __('Instruments', PLUGIN_TEXTDOMAIN),
						'name'              => self::$INSTRUMENTS,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$VIDEO_LINK,
						'label'             => __('Video link', PLUGIN_TEXTDOMAIN),
						'name'              => self::$VIDEO_LINK,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$GENRES,
						'label'             => __('Genres', PLUGIN_TEXTDOMAIN),
						'name'              => self::$GENRES,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$FEMALE_VOCAL,
						'label'             => __('Female vocal', PLUGIN_TEXTDOMAIN),
						'name'              => self::$FEMALE_VOCAL,
						'type'              => 'true_false',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$MALE_VOCAL,
						'label'             => __('Male vocal', PLUGIN_TEXTDOMAIN),
						'name'              => self::$MALE_VOCAL,
						'type'              => 'true_false',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$WEBSITE,
						'label'             => __('Website', PLUGIN_TEXTDOMAIN),
						'name'              => self::$WEBSITE,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$INSTAGRAM,
						'label'             => __('Instagram', PLUGIN_TEXTDOMAIN),
						'name'              => self::$INSTAGRAM,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$FACEBOOK,
						'label'             => __('Facebook', PLUGIN_TEXTDOMAIN),
						'name'              => self::$FACEBOOK,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$TAGS,
						'label'             => __('Tags', PLUGIN_TEXTDOMAIN),
						'name'              => self::$TAGS,
						'type'              => 'taxonomy',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$YEAR_OF_FOUNDATION,
						'label'             => __('Year of foundation', PLUGIN_TEXTDOMAIN),
						'name'              => self::$YEAR_OF_FOUNDATION,
						'type'              => 'text',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					),
					array(
						'key'               => self::$GRANTED,
						'label'             => __('Granted', PLUGIN_TEXTDOMAIN),
						'name'              => self::$GRANTED,
						'type'              => 'true_false',
						'prefix'            => '',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					)
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => self::$POST_TYPE
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => ''
			]
		);

	}
}
