<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Request_Validation_Result;
use Ew\WpHelpers\Services\Validation_Service;

/**
 * Class Music_Band_Service
 * @package EwStarter
 */
class Music_Band_Service extends Validation_Service {

	/**
	 * @var Music_Band_Repository
	 */
	private $applications_repository;

	/**
	 * Music_Band_Service constructor.
	 * @throws \Exception
	 */
	public function __construct() {
		$this->applications_repository = new Music_Band_Repository();
	}

	/**
	 * @param array $r
	 *
	 * @return Request_Validation_Result
	 */
	public function validate_create( array $r ) {
		$result			= new Request_Validation_Result();
		$required_fields = [
		'bandName',
		'phone',
		'email',
		'city',
		'country',
		'availableLocations',
		'members',
		'instruments',
		'videoLink',
		'genres',
		// 'femaleVocal',
		// 'maleVocal',
		// 'website',
		// 'instagram',
		// 'facebook',
		// 'tags',
		// 'yearOfFoundation',
		// 'shortDescription',
		// 'granted'
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
	 * @return Music_Band
	 * @throws Validation_Exception
	 * @throws \Exception
	 */
	public function create( array $r ) {

		$full_name	= "{$r['bandName']}";

		// Create wp post
		$post_id = wp_insert_post([
			'post_title'	=> $full_name,
			'post_status'	=> 'publish',
			'post_type'		=> Music_Band::$POST_TYPE,
			'post_name'		=> $full_name,
			'post_excerpt'	=> $r['shortDescription']
		]);

		if( empty($post_id)){
			throw new \Exception('Post could not be created');
		}

		$post = get_post( $post_id );

		// Validate request
		// $validation_result = $this->validate_create( $r );

		// If the result is not valid throw request validation exception
		// if ( ! $validation_result->is_valid() ) {
		// 	throw new Validation_Exception( $validation_result->get_message() );
		// }

		try {
			// Save prize game registration to the db
			$application						= new Music_Band([], $post);
			$application->band_name				= sanitize_text_field( $r['bandName'] );
			$application->phone					= sanitize_text_field( $r['phone'] );
			$application->email					= sanitize_text_field( $r['email'] );
			$application->city					= sanitize_text_field( $r['city'] );
			$application->country				= sanitize_text_field( $r['country'] );
			$application->available_locations	= sanitize_text_field( $r['availableLocations'] );
			$application->members				= sanitize_text_field( $r['members'] );
			$application->instruments			= sanitize_text_field( $r['instruments'] );
			$application->video_link			= sanitize_text_field( $r['videoLink'] );
			$application->genres				= sanitize_text_field( $r['genres'] );
			$application->female_vocal			= sanitize_text_field( $r['femaleVocal'] );
			$application->male_vocal			= sanitize_text_field( $r['maleVocal'] );
			$application->website				= sanitize_text_field( $r['website'] );
			$application->instagram				= sanitize_text_field( $r['instagram'] );
			$application->facebook				= sanitize_text_field( $r['facebook'] );
			$application->tags					= sanitize_text_field( $r['tags'] );
			$application->year_of_foundation	= sanitize_text_field( $r['yearOfFoundation'] );
			$application->short_description		= sanitize_text_field( $r['shortDescription'] );
			$application->granted				= sanitize_text_field( $r['granted'] );
			$application->date_created			= new \DateTime();

			// Return saved user registration
			return $this->applications_repository->save( $application );
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
}