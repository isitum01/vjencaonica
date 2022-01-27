<?php

namespace Vjencaonica;

use Ew\WpHelpers\Classes\Db_Data;
use Ew\WpHelpers\Repositories\ARepository;

/**
 * Class Music_Band_Repository
 * @package Vjencaonica
 */
class Music_Band_Repository extends ARepository
{

	/**
	 * Music_Band_Repository constructor.
	 *
	 * @param string $table_name
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		parent::__construct('vj_music_bands');
	}

	/**
	 * @param $id
	 *
	 * @return bool|Music_Band
	 * @throws \Exception
	 */
	public function get_by_id($id)
	{
		return $this->_get_single_by_field('id', intval($id), '%d');
	}

	/**
	 * Save Music band.
	 *
	 * @param Music_Band $music_band
	 *
	 * @return Music_Band
	 * @throws \Exception
	 */
	public function save($music_band)
	{
		$db_data = $this->get_db_data($music_band);
		$db_row = $this->get_db_row($music_band->id);

		if (empty($music_band->id)) {
			throw new \Exception('music_band id is empty!');
		}

		if (!empty($db_row)) {
			// Update in the db
			$res = $this->db->update(
				$this->table_name,
				$db_data['values'],
				['id' => $music_band->id],
				$db_data['formats'],
				'%d'
			);

			// Check if updated
			if ($res === false) {
				throw new \Exception('Music_Band_Registration UPDATE failed!');
			}
		} else {
			$db_data['formats'][] = '%d';
			// Insert into db
			$res = $this->db->insert(
				$this->table_name,
				$db_data['values']
			);

			// Check if insert failed
			if ($res === false) {
				throw new \Exception('Music_Band_Registration CREATE failed!');
			}
		}

		return $music_band;
	}

	/**
	 * @param Music_Band $music_band
	 *
	 * @return array
	 */
	private function get_db_data($music_band)
	{
		$db_data = new Db_Data();

		$db_data->add_data('id', $music_band->id, '%d');
		$db_data->add_data('band_name', $music_band->band_name, '%s');
		$db_data->add_data('phone', $music_band->phone, '%s');
		$db_data->add_data('email', $music_band->email, '%s');
		$db_data->add_data('city', $music_band->city, '%s');
		$db_data->add_data('country', $music_band->country, '%s');
		$db_data->add_data('available_locations', $music_band->available_locations, '%s');
		$db_data->add_data('members', $music_band->members, '%s');
		$db_data->add_data('instruments', $music_band->instruments, '%s');
		$db_data->add_data('video_link', $music_band->video_link, '%s');
		$db_data->add_data('genres', $music_band->genres, '%s');
		$db_data->add_data('female_vocal', $music_band->female_vocal, '%s');
		$db_data->add_data('male_vocal', $music_band->male_vocal, '%s');
		$db_data->add_data('website', $music_band->website, '%s');
		$db_data->add_data('instagram', $music_band->instagram, '%s');
		$db_data->add_data('facebook', $music_band->facebook, '%s');
		$db_data->add_data('tags', $music_band->tags, '%s');
		$db_data->add_data('year_of_foundation', $music_band->year_of_foundation, '%s');
		$db_data->add_data('short_description', $music_band->short_description, '%s');
		$db_data->add_data('granted', $music_band->granted, '%s');
		$db_data->add_data('date_created', $music_band->date_created->format(DATE_ATOM), '%s');

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
	protected function _construct_object($table_row, $object_data = null)
	{
		return new Music_Band($table_row, $object_data);
	}

	/**
	 * @param int $id
	 *
	 * @return array|null|object
	 */
	private function get_db_row($id)
	{
		$query = $this->db->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", intval($id));

		return $this->db->get_row($query, ARRAY_A);
	}
}
