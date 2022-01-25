<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Db_Data;
use Ew\WpHelpers\Repositories\ARepository;

/**
 * Class Ketchup_Gang_Registration_Repository
 * @package Vjencaonica
 */
class Ketchup_Gang_Registration_Repository extends ARepository {

	/**
	 * Ketchup_Gang_Registration_Repository constructor.
	 *
	 * @throws \Exception
	 */
	public function __construct() {
		parent::__construct( 'ew_ketchup_gang_registration' );
	}

	/**
	 * @param $id
	 *
	 * @return bool|Ketchup_Gang_Registration
	 * @throws \Exception
	 */
	public function get_by_id( $id ) {
		return $this->_get_single_by_field( 'id', intval( $id ), '%d' );
	}

	/**
	 * Save application.
	 *
	 * @param Ketchup_Gang_Registration $application
	 *
	 * @return Ketchup_Gang_Registration
	 * @throws \Exception
	 */
	public function save( $application ) {
		var_dump($application);
		$db_data = $this->get_db_data( $application );

		$db_row = $this->get_db_row( $application->id );

		if ( ! empty( $db_row ) ) {
			// Update in the db
			$res = $this->db->update(
				$this->table_name,
				$db_data['values'],
				[ 'id' => $application->id ],
				$db_data['formats'],
				'%d'
			);

			// Check if updated
			if ( $res === false ) {
				throw new \Exception( 'Ketchup_Gang_Registration UPDATE failed!' );
			}
		} else {
			$db_data['formats'][] = '%d';
			// Insert into db
			$res = $this->db->insert(
				$this->table_name,
				$db_data['values']
			);

			// Check if insert failed
			if ( $res === false ) {
				throw new \Exception( 'Ketchup_Gang_Registration CREATE failed!' );
			}
		}

		return $application;
	}

	/**
	 * @param Ketchup_Gang_Registration $application
	 *
	 * @return array
	 */
	private function get_db_data( $application ) {
		$db_data = new Db_Data();

		$db_data->add_data( 'id', $application->id, '%d' );
		$db_data->add_data( 'first_name', $application->first_name, '%s' );
		$db_data->add_data( 'last_name', $application->last_name, '%s' );
		$db_data->add_data( 'email', $application->email, '%s' );		
		$db_data->add_data( 'phone', $application->phone, '%s' );
		$db_data->add_data( 'gang_choice', $application->gang_choice, '%s' );
		$db_data->add_data( 'date_created', $application->date_created->format( DATE_ATOM ), '%s' );

		return $db_data->get_data();
	}

	/**
	 * Constructs object instance from table row and additional object data.
	 * Additional data could be WP_Post object or any other data related
	 * to object that is not stored in object table.
	 *
	 * @since   1.0.0
	 *
	 * @param array $table_row
	 * @param mixed $object_data
	 *
	 * @return          mixed
	 */
	protected function _construct_object( $table_row, $object_data = null ) {
		return new Ketchup_Gang_Registration( $table_row, $object_data );
	}

	/**
	 * @param int $id
	 *
	 * @return array|null|object
	 */
	private function get_db_row( $id ) {
		$query = $this->db->prepare( "SELECT * FROM {$this->table_name} WHERE id = %d", intval( $id ) );

		return $this->db->get_row( $query, ARRAY_A );
	}
}