<?php

namespace Vjencaonica;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    VjencaonicaPlugin
 * @subpackage VjencaonicaPlugin/includes
 */
class VjencaonicaPlugin
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      VjencaonicaPlugin_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{

		$this->plugin_name = 'vjencaonica-plugin';
		$this->version     = '1.0.0';

		$this->load_dependencies();
		$this->define_admin_hooks();
		// $this->define_public_hooks();
		$this->initialize_post_types();
		$this->init_controllers();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	private function load_dependencies()
	{
		/**
		 * Include constants required for plugin to work.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . '/constants.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once PLUGIN_DIR . '/includes/class-vjencaonicaplugin-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once PLUGIN_DIR . '/admin/class-vjencaonicaplugin-admin.php';

		/**
		 * Include autoload for all packages.
		 */
		require_once PLUGIN_DIR . '/vendor/autoload.php';

		// Load exceptions
		require_once PLUGIN_DIR . 'exceptions/class-validation-exception.php';

		// Load post-types
		require_once PLUGIN_DIR . 'post-types/class-music-band.php';

		// Load repositories
		require_once PLUGIN_DIR . 'repositories/class-music-band-repository.php';

		// Load services
		require_once PLUGIN_DIR . 'services/class-music-band-service.php';

		// Load controllers
		require_once PLUGIN_DIR . 'controllers/class-avjencaonica-controller.php';
		require_once PLUGIN_DIR . 'controllers/class-music-band-controller.php';

		$this->loader = new VjencaonicaPlugin_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	private function define_admin_hooks()
	{
		$plugin_admin = new VjencaonicaPlugin_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		// $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_pages' );
	}

	/**
	 * Initializes all new post types.
	 *
	 * @since 1.0.0
	 */
	private function initialize_post_types()
	{
		// Init all custom post types.
		Music_Band::load_class($this->loader);
	}

	/**
	 * Initializes all custom REST API controllers.
	 *
	 * @since 1.0.0
	 * @throws \Exception
	 */
	private function init_controllers()
	{
		$controllers = [
			new Music_Band_Controller()
		];

		foreach ($controllers as $controller) {
			$this->loader->add_action('rest_api_init', $controller, 'register_routes');
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name(): string
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    VjencaonicaPlugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader(): VjencaonicaPlugin_Loader
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version(): string
	{
		return $this->version;
	}
}
