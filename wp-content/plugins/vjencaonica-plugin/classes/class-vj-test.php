<?php

namespace Vjencaonica;

class Vj_Test
{
    public static $POST_TYPE = "vj-test";
    public static $LABEL = "VJ-test";
    public static $SLUG = "vj-testovi";

    public static $FIRST_NAME = 'first_name';
    public static $LAST_NAME = 'last_name';


    public $id;
    public $first_name;
    public $last_name;

    public function __construct($wp_post, $row = [])
    {
        if (empty($wp_post)) {
            throw new \Exception('No post in vj-test constructor');
        }

        $this->id           = $wp_post->ID;
        $this->first_name   = $wp_post->get_field(self::$FIRST_NAME, $wp_post->ID);
        $this->last_name    = $wp_post->get_field(self::$LAST_NAME, $wp_post->ID);
    }

    public static function load_class($loader)
    {
        // $loader->add_action('acf/init', static::class, 'vj_test_add_local_field_groups');
        $loader->add_action('init', static::class, 'init_post_type');
    }

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
            'edit_item'          => __('Edit recipe', PLUGIN_TEXTDOMAIN),
            'view_item'          => __('View recipe', PLUGIN_TEXTDOMAIN),
            'all_items'          => __('All recipes', PLUGIN_TEXTDOMAIN),
            'search_items'       => __('Search recipes', PLUGIN_TEXTDOMAIN),
            'parent_item_colon'  => __('Parent recipe:', PLUGIN_TEXTDOMAIN),
            'not_found'          => __('No recipe found', PLUGIN_TEXTDOMAIN),
            'not_found_in_trash' => __('No recipe found in trash', PLUGIN_TEXTDOMAIN)
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
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => 'dashicons-admin-page',
            'supports'           => array(
                'title',
                'editor',
                'excerpt'
            ),
            'show_in_rest'       => true
        ];

        // Register post type
        register_post_type(static::$POST_TYPE, $args);
    }

    /**
     * Add custom fields for recipe
     */
    public static function vj_test_add_local_field_groups()
    {
        // Fields for Recipe
        acf_add_local_field_group(
            array(
                'key'                   => 'group_recipe',
                'title'                 => __('Recipe', PLUGIN_TEXTDOMAIN),
                'fields'                => array(
                    array(
                        'key'               => self::$FIRST_NAME,
                        'label'             => __('Time', PLUGIN_TEXTDOMAIN),
                        'name'              => self::$FIRST_NAME,
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
                        'key'               => self::$LAST_NAME,
                        'label'             => __('No. of people', PLUGIN_TEXTDOMAIN),
                        'name'              => self::$LAST_NAME,
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
                    )                    
                ),
                'location'              => array(
                    array(
                        array(
                            'param'    => 'post_type',
                            'operator' => '==',
                            'value'    => 'ew-recipe',
                        ),
                    ),
                ),
                'menu_order'            => 0,
                'position'              => 'side',
                'style'                 => 'default',
                'label_placement'       => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen'        => '',
            )
        );
    }
}
