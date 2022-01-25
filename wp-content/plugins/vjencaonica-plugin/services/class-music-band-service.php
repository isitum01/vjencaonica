<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Request_Validation_Result;
use Ew\WpHelpers\Services\Validation_Service;

/**
 * Class Music_Band_Service
 * @package Vjencaonica
 */
class Music_Band_Service extends Validation_Service {
	/*
	 * @var Music_Band_Repository
	 */
	private $music_band_repository;

	/**
	 * Music_Band constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct() {
		$this->music_band_repository 	= new Music_Band_Repository();
	}

	/**
	 * @param array $r
	 *
	 * @return Request_Validation_Result
	 */
	public function validate_create( array $r ) {
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

		foreach ( $required_fields as $required_field ) {
			$result->merge( $this->not_empty( $r, $required_field, 'music_band_create' ) );
		}

		return $result;
	}

	/**
	 * Creates new Music Band.
	 *
	 * @param array $r
	 *
	 * @return Music_Band
	 * @throws \Exception
	 */
	public function create( array $r ) {
		$slug              = Random_Values_Helper::get_random_string( 8 );
		$last_name_initial = mb_substr( mb_strtoupper( $r['lastName'] ), 0, 1 );
		$full_name         = "{$r['firstName']} $last_name_initial.";

		// Create wp post
		$post_id = wp_insert_post( [
			'post_title'   => $full_name,
			'post_status'  => 'publish',
			'post_type'    => Music_Band::POST_TYPE,
			'post_name'    => $slug,
			'post_excerpt' => $r['description']
		] );

		if ( empty( $post_id ) ) {
			throw new \Exception( 'Post could not be created' );
		}
		$post = get_post( $post_id );

		// Create Music_Band registration for post
		$music_band = new Music_Band([], $post);
		$music_band->band_name 		        = $r['bandName'];
		$music_band->phone		            = $r['phone'];
		$music_band->email    		        = $r['email'];
		$music_band->city   	            = $r['city'];
		$music_band->country       		    = $r['country'];
		$music_band->available_locations    = $r['availableLocations'];
		$music_band->members    		    = $r['members'];
		$music_band->instruments      	    = $r['instruments'];
		$music_band->email      		    = $r['email'];
		$music_band->genres	                = $r['genres'];
		$music_band->femaleVocal	        = $r['femaleVocal'];
		$music_band->maleVocal	            = $r['maleVocal'];
		$music_band->website	            = $r['website'];
		$music_band->instagram	            = $r['instagram'];
		$music_band->facebook	            = $r['facebook'];
		$music_band->tags	                = $r['tags'];
		$music_band->year_of_foundation     = $r['yearOfFoundation'];
		$music_band->description	        = $r['description'];
		$music_band->granted	        	= $r['granted'];
		$music_band->date_created    	    = new \DateTime();

		$music_band = $this->music_band_repository->save( $music_band );

		return $music_band;
	}
}