<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Request_Validation_Result;
use Ew\WpHelpers\Services\Validation_Service;

/**
 * Class Music_Band_Service
 * @package Vjencaonica
 */
class Music_Band_Service extends Validation_Service
{
	/*
	 * @var Music_Band_Repository
	 */
	private $music_band_repository;

	/**
	 * Music_Band constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->music_band_repository 	= new Music_Band_Repository();
	}

	/**
	 * @param array $r
	 *
	 * @return Request_Validation_Result
	 */
	public function validate_create(array $r)
	{
		$result          = new Request_Validation_Result();
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
			'femaleVocal',
			'maleVocal',
			'website',
			'instagram',
			'facebook',
			'tags',
			'yearOfFoundation',
			'description'
		];

		foreach ($required_fields as $required_field) {
			$result->merge($this->not_empty($r, $required_field, 'music_band_create'));
		}

		// Skip additional validation if any field is empty
		if (!$result->is_valid()) {
			return $result;
		}

		// Validate email
		if (!filter_var($r['email'], FILTER_VALIDATE_EMAIL)) {
			$result->add_error_message('[email] is not valid');
		}

		return $result;
	}

	/**
	 * Creates new Music Band application.
	 *
	 * @param array $r
	 *
	 * @return Music_Band
	 * @throws \Exception
	 */
	public function create(array $r)
	{
		// Validate request
		$validation_result = $this->validate_create($r);

		// If the result is not valid throw request validation exception
		if (!$validation_result->is_valid()) {
			throw new Validation_Exception($validation_result->get_message());
		}

		try {
			// Save prize game registration to the db
			$application                        = new Ketchup_Gang_Registration();
			$application->band_name				= sanitize_text_field($r['bandName']);
			$application->phone					= sanitize_text_field($r['phone']);
			$application->email					= sanitize_text_field($r['email']);
			$application->city					= sanitize_text_field($r['city']);
			$application->country				= sanitize_text_field($r['country']);
			$application->available_locations	= sanitize_text_field($r['availableLocations']);
			$application->members				= sanitize_text_field($r['members']);
			$application->instruments			= sanitize_text_field($r['instruments']);
			$application->video_link			= sanitize_text_field($r['videoLink']);
			$application->genres				= sanitize_text_field($r['genres']);
			$application->female_vocal			= sanitize_text_field($r['femaleVocal']);
			$application->male_vocal			= sanitize_text_field($r['maleVocal']);
			$application->website				= sanitize_text_field($r['website']);
			$application->instagram				= sanitize_text_field($r['instagram']);
			$application->facebook				= sanitize_text_field($r['facebook']);
			$application->tags					= sanitize_text_field($r['tags']);
			$application->yearOfFoundation		= sanitize_text_field($r['yearOfFoundation']);
			$application->description			= sanitize_text_field($r['description']);
			$application->date_created			= new \DateTime();


			// Return saved user registration
			return $this->applications_repository->save($application);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
