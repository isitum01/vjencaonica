<?php

/**
 * Created by PhpStorm.
 * User: Mateo Mlikota
 * Date: 7. 2. 2021.
 * Time: 16:44
 */

namespace Vjencaonica;

/**
 * Class Recipe
 * @package VegetaBio
 */
class Recipe
{
	public static $POST_TYPE = 'recipe';
	public static $SLUG = 'recepti';

	public static $IMAGE = 'recipe_image';
	public static $TIME = 'recipe_time';
	public static $PEOPLE = 'recipe_people';
	public static $LEVEL = 'recipe_level';
	public static $TIP = 'recipe_tip';
	public static $FP_FEATURED_RECIPE = 'featured_recipe';

	/**
	 * @var int
	 */
	public $id;
	/**
	 * @var string
	 */
	public $title;
	/**
	 * @var string
	 */
	public $content;
	/**
	 * @var string
	 */
	public $excerpt;
	/**
	 * @var false|string
	 */
	public $featuredImage;
	/**
	 * @var string
	 */
	public $time;
	/**
	 * @var string
	 */
	public $people;
	/**
	 * @var string
	 */
	public $level;
	/**
	 * @var string
	 */
	public $tip;


	/**
	 * Recipe constructor.
	 *
	 * @param $wp_post
	 * @param array $row
	 *
	 * @throws \Exception
	 */
	public function __construct(\WP_Post $wp_post, $row = [])
	{
		if (empty($wp_post)) {
			throw new \Exception('No post in product constructor');
		}

		$this->id           	= $wp_post->ID;
		$this->title       		= $wp_post->post_title;
		$this->content     	 	= $wp_post->post_content;
		$this->excerpt      	= $wp_post->post_excerpt;
		$this->featuredImage    = get_field(self::$IMAGE, $wp_post->ID);
		$this->time      		= get_field(self::$TIME, $wp_post->ID);
		$this->people   	 	= get_field(self::$PEOPLE, $wp_post->ID);
		$this->level	     	= get_field(self::$LEVEL, $wp_post->ID);
		$this->tip	    		= get_field(self::$TIP, $wp_post->ID);
	}

	/**
	 * Load Recipe class
	 *
	 * @param $loader
	 */
	public static function load_class($loader)
	{
		// Init post type
		$loader->add_action('init', static::class, 'init_post_type');

		// Create custom fields
		$loader->add_action('acf/init', static::class, 'recipe_add_local_field_groups');
	}

	/**
	 * Register recipe custom post type.
	 */
	public static function init_post_type()
	{
		$labels = [
			'name'               => _x('Recipes', 'post type general name', PLUGIN_TEXTDOMAIN),
			'singular_name'      => _x('Recipe', 'post type singular name', PLUGIN_TEXTDOMAIN),
			'menu_name'          => _x('Recipes', 'admin menu', PLUGIN_TEXTDOMAIN),
			'name_admin_bar'     => _x('Recipes', 'add new on admin bar', PLUGIN_TEXTDOMAIN),
			'add_new'            => _x('Add new', static::$POST_TYPE, PLUGIN_TEXTDOMAIN),
			'add_new_item'       => __('Add new recipe', PLUGIN_TEXTDOMAIN),
			'new_item'           => __('New recipe', PLUGIN_TEXTDOMAIN),
			'edit_item'          => __('Update recipe', PLUGIN_TEXTDOMAIN),
			'view_item'          => __('View recipe', PLUGIN_TEXTDOMAIN),
			'all_items'          => __('All recipes', PLUGIN_TEXTDOMAIN),
			'search_items'       => __('Search recipes', PLUGIN_TEXTDOMAIN),
			'parent_item_colon'  => __('Parent recipe:', PLUGIN_TEXTDOMAIN),
			'not_found'          => __('Recipe not found', PLUGIN_TEXTDOMAIN),
			'not_found_in_trash' => __('Recipe not found in trash', PLUGIN_TEXTDOMAIN)
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
			'rewrite'            => array('slug' => self::$SLUG),
			'capability_type'    => 'post',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => [
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			],
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-pressthis'
		];

		// Register post type
		register_post_type(static::$POST_TYPE, $args);
	}

	/**
	 * Add custom fields for recipe.
	 */
	public static function recipe_add_local_field_groups()
	{
		acf_add_local_field_group(
			[
				'key'                   => 'group_recipe',
				'title'                 => __('Recipe', PLUGIN_TEXTDOMAIN),
				'fields'                => array(
					array(
						'key'               => self::$TIME,
						'label'             => __('Time', PLUGIN_TEXTDOMAIN),
						'name'              => self::$TIME,
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
						'key'               => self::$PEOPLE,
						'label'             => __('No. of people', PLUGIN_TEXTDOMAIN),
						'name'              => self::$PEOPLE,
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
						'key'               => self::$LEVEL,
						'label'             => __('Level', PLUGIN_TEXTDOMAIN),
						'name'              => self::$LEVEL,
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
						'key'               => self::$TIP,
						'label'             => __('Tip', PLUGIN_TEXTDOMAIN),
						'name'              => self::$TIP,
						'type'              => 'textarea',
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
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => ''
			]
		);

		acf_add_local_field_group( array(
			'key'                   => 'group_6141ff534a690',
			'title'                 => __( 'Istaknuti recepti', PLUGIN_TEXTDOMAIN ),
			'fields'                => array(
			   array(
				  'key'               => 'field_6141ff750b78f',
				  'label'             => __( 'Recepti', PLUGIN_TEXTDOMAIN ),
				  'name'              => self::$FP_FEATURED_RECIPE,
				  'type'              => 'relationship',
				  'instructions'      => '',
				  'required'          => 0,
				  'conditional_logic' => 0,
				  'wrapper'           => array(
					 'width' => '',
					 'class' => '',
					 'id'    => '',
				  ),
				  'post_type'         => array(
					 0 => self::$POST_TYPE,
				  ),
				  'taxonomy'          => '',
				  'filters'           => array(
					 0 => 'search',
				  ),
				  'elements'          => array(
					 0 => 'featured_image',
				  ),
				  'min'               => '',
				  'max'               => '',
				  'return_format'     => 'object',
			   ),
			),
			'location'              => array(
			   array(
				  array(
					 'param'    => 'page_type',
					 'operator' => '==',
					 'value'    => 'front_page',
				  ),
			   ),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		 ) );
	}
}
