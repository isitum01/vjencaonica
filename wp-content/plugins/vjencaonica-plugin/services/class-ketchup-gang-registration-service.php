<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Request_Validation_Result;
use Ew\WpHelpers\Services\Validation_Service;

/**
 * Class Ketchup_Gang_Registration_Service
 * @package Vjencaonica
 */
class Ketchup_Gang_Registration_Service extends Validation_Service {

	/**
	 * @var Ketchup_Gang_Registration_Repository
	 */
	private $applications_repository;

	/**
	 * Ketchup_Gang_Registration_Service constructor.
	 * @throws \Exception
	 */
	public function __construct() {
		$this->applications_repository = new Ketchup_Gang_Registration_Repository();
	}

	/**
	 * @param array $r
	 *
	 * @return Request_Validation_Result
	 */
	public function validate_create( array $r ) {
		$result          = new Request_Validation_Result();
		$required_fields = [
			'firstName',
			'lastName',
			'email',
			'phone',
			'gangChoice'
		];

		foreach ( $required_fields as $required_field ) {
			$result->merge( $this->not_empty( $r, $required_field, 'application_create' ) );
		}

		// Skip additional validation if any field is empty
		if ( ! $result->is_valid() ) {
			return $result;
		}

		// Validate email
		if ( ! filter_var( $r['email'], FILTER_VALIDATE_EMAIL ) ) {
			$result->add_error_message( '[email] is not valid' );
		}

		return $result;
	}

	/**
	 * Creates new user application.
	 *
	 * @param array $r
	 *
	 * @return Ketchup_Gang
	 * @throws Validation_Exception
	 * @throws \Exception
	 */
	public function create( array $r ) {
		// Validate request
		$validation_result = $this->validate_create( $r );

		// If the result is not valid throw request validation exception
		if ( ! $validation_result->is_valid() ) {
			throw new Validation_Exception( $validation_result->get_message() );
		}

		try {
			// Save prize game registration to the db
			$application                        = new Ketchup_Gang_Registration();
			$application->first_name            = sanitize_text_field( $r['firstName'] );
			$application->last_name             = sanitize_text_field( $r['lastName'] );
			$application->email                 = sanitize_text_field( $r['email'] );
			$application->phone                 = sanitize_text_field( $r['phone'] );
			$application->gang_choice      	    = sanitize_text_field( $r['gangChoice'] );
			$application->date_created          = new \DateTime();

			// Return saved user registration
			return $this->applications_repository->save( $application );
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
}