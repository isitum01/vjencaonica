<?php

namespace Vjencaonica;

use WP_REST_Request;
use WP_REST_Server;

/**
 * Class Ketchup_Gang_Registration_Controller
 * @package Vjencaonica
 */
class Ketchup_Gang_Registration_Controller extends APKPlugin_Controller {

	/**
	 * @var Ketchup_Gang_Registration_Service
	 */
	private $applications_service;

	/**
	 * Ketchup_Gang_Registration_Controller constructor.
	 * @throws \Exception
	 */
	public function __construct() {
		parent::__construct( 'ew_ketchup_gang_registration' );
		$this->applications_service = new Ketchup_Gang_Registration_Service();
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
				'callback' => [ $this, 'create_ketchup_gang_registration' ]
			]
		);
	}

	/**
	 * Creates par ili ne par registration.
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function create_ketchup_gang_registration( WP_REST_Request $request ) {
		try {
			// Create par ili ne par registration from params
			$application = $this->applications_service->create( $request->get_params() );

			return $this->ok( $application );
		} catch ( Validation_Exception $e ) {
			return $this->bad_request( $e->getMessage() );
		} catch ( \Exception $e ) {
			return $this->exception_response( $e );
		}
	}
}
