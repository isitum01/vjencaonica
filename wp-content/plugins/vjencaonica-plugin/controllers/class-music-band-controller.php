<?php

namespace Vjencaonica;

use WP_REST_Request;
use WP_REST_Server;

/**
 * Class Music_Band_Controller
 * @package EwStarter
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
				'methods'  => WP_REST_Server::CREATABLE,
				'callback' => [ $this, 'create_music_band_registration' ]
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
		try {
			// Create music band registration from params
			$application = $this->applications_service->create( $request->get_params() );

			return $this->ok( $application );
		} catch ( Validation_Exception $e ) {
			return $this->bad_request( $e->getMessage() );
		} catch ( \Exception $e ) {
			return $this->exception_response( $e );
		}
	}
}
