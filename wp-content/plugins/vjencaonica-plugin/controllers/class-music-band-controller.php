<?php

namespace Vjencaonica;

use WP_REST_Request;

/**
 * Class Music_Band_Controller
 * @package Vjencaonica
 */
class Music_Band_Controller extends VjencaonicaPlugin_Controller {

	/**
	 * @var Music_Band_Service
	 */
	private $applications_service;

	/**
	 * Music_Band_Controller constructor.
	 * @throws \Exception
	 */
	public function __construct() {
		parent::__construct( 'vj_music_band_registration' );
		$this->applications_service = new Music_Band_Service();
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

	/**
	 * Creates music band registration.
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function create_music_band_registration( WP_REST_Request $request ) {

		$r =  $request->get_params();

		$result = $this->applications_service->validate_create( $r );
		if( ! $result->is_valid()){
			return $this->bad_request( $result->get_message());
		}

		try {
			// Create music band registration from params
			$application = $this->applications_service->create( $request->get_params() );

			// return $this->ok( $application );

			return $this->ok([
				'application'	=> $application,
				'permalink'		=> get_permalink($application->wp_post)
			]);

		} catch ( Validation_Exception $e ) {
			return $this->bad_request( $e->getMessage() );
		} catch ( \Exception $e ) {
			return $this->exception_response( $e );
		}
	}
}
