<?php

namespace Vjencaonica;

class Music_Band_Controller extends VjencaonicaPlugin_Controller {
	/**
	 * @var Music_Band_Service
	 */
	private $music_band_service;

	/**
	 * Music_Band_Controller constructor.
	 *
	 * @param string $route
	 *
	 * @throws \Exception
	 */
	public function __construct() {
		parent::__construct( 'vj-music-band-registration' );
		$this->music_band_service = new Music_Band_Service();
	}

	/**
	 * Registers all controller routes.
	 * In this function all routes for this controller are registered
	 * using WordPress function register_route
	 *
	 * @since   1.0.0
	 */
	public function register_routes() {
		register_rest_route(
			$this->get_namespace(),
			"/" . $this->route,
			[
				'methods'  => 'POST',
				'callback' => [ $this, 'create_music_band_registration' ],
				'permission_callback' => '__return_true'
			]
		);

	}

	public function create_music_band_registration( \WP_REST_Request $request ) {
		$r      = $request->get_params();
		
		$result = $this->music_band_service->validate_create( $r );
		if ( ! $result->is_valid() ) {
			return $this->bad_request( $result->get_message() );
		}

		try {
			$application = $this->music_band_service->create( $r );

			return $this->ok( [
				'application' => $application,
				'permalink'   => get_permalink( $application->wp_post )
			] );
		} catch ( \Exception $e ) {
			return $this->exception_response( $e );
		}
	}
}