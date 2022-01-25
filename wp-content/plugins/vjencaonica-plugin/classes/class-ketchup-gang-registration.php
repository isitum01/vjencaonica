<?php

namespace Vjencaonica;

/**
 * Class Ketchup_Gang_Registration
 * @package Vjencaonica
 */
class Ketchup_Gang_Registration {
	const POST_TYPE = 'ketchup-gang';
	const SLUG = 'ketchup-gang-prijave';

	/**
	 * @var int
	 */
	public $id;
	/**
	 * @var string
	 */
	public $first_name;
	/**
	 * @var string
	 */
	public $last_name;
	/**
	 * @var string
	 */
	public $email;
	/**
	 * @var string
	 */
	public $phone;
	/**
	 * @var string
	 */
	public $gang_choice;
	/**
	 * @var \DateTime
	 */
	public $date_created;

	/**
	 * Ketchup_Gang_Registration constructor.
	 *
	 * @param array $row
	 * @param null $wp_post
	 */
	public function __construct( $row = [], $post = null ) {
		// Init current date as date created
		$this->date_created = new \DateTime();

		// We construct empty object
		if ( empty( $row ) ) {
			return;
		}

		// We assume that all row fields are filled in
		// since we have validation for that
		$this->id                    = intval( $row['id'] );
		$this->first_name            = $row['first_name'];
		$this->last_name             = $row['last_name'];
		$this->email                 = $row['email'];		
		$this->phone                 = $row['phone'];
		$this->gang_choice	         = $row['gang_choice'];
		$this->date_created          = \DateTime::createFromFormat( DATE_ATOM, $row['date_created'] );
	}

	/**
	 * Loads the class.
	 *
	 * @param $loader
	 */
	public static function load_class( $loader ) {
		// Initializes new post type
		$loader->add_action( 'init', static::class, 'init_post_type' );
	}

	/**
	 * Registers Ketchup Gang registration custom post type.
	 */
	public static function init_post_type() {
		$labels = [
			'name'               => _x( 'Ketchup Gang Registrations', 'post type general name', PLUGIN_TEXTDOMAIN ),
			'singular_name'      => _x( 'Ketchup Gang Registration', 'post type singular name', PLUGIN_TEXTDOMAIN ),
			'menu_name'          => _x( 'Ketchup Gang Registrations', 'admin menu', PLUGIN_TEXTDOMAIN ),
			'name_admin_bar'     => _x( 'Ketchup Gang Registration', 'add new on admin bar', PLUGIN_TEXTDOMAIN ),
			'add_new'            => _x( 'Add New', 'book', PLUGIN_TEXTDOMAIN ),
			'add_new_item'       => __( 'Add New Ketchup Gang Registration', PLUGIN_TEXTDOMAIN ),
			'new_item'           => __( 'New Ketchup Gang Registration', PLUGIN_TEXTDOMAIN ),
			'edit_item'          => __( 'Edit Ketchup Gang Registration', PLUGIN_TEXTDOMAIN ),
			'view_item'          => __( 'View Ketchup Gang Registration', PLUGIN_TEXTDOMAIN ),
			'all_items'          => __( 'All Ketchup Gang Registrations', PLUGIN_TEXTDOMAIN ),
			'search_items'       => __( 'Search Ketchup Gang Registrations', PLUGIN_TEXTDOMAIN ),
			'parent_item_colon'  => __( 'Parent Ketchup Gang Registrations:', PLUGIN_TEXTDOMAIN ),
			'not_found'          => __( 'No registrations found.', PLUGIN_TEXTDOMAIN ),
			'not_found_in_trash' => __( 'No registrations found in Trash.', PLUGIN_TEXTDOMAIN )
		];

		$args = [
			'labels'             => $labels,
			'description'        => __( 'Description.', PLUGIN_TEXTDOMAIN ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => false,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => [ 'slug' => self::SLUG ],
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => [ 'title', 'editor' ],
			'menu_icon'          => 'dashicons-id-alt',
			'show_in_rest'       => false
		];

		// Register post type
		register_post_type( static::POST_TYPE, $args );
	}
}