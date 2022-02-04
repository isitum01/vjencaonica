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
	 *  Music_Band_Repository constructor.
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
	 * @return bool| Music_Band
	 * @throws \Exception
	 */
	public function get_by_id($id)
	{
		return $this->_get_single_by_field('id', intval($id), '%d');
	}

	public function get_all()
	{
		global $wpdb;
		$result = $wpdb->get_results("SELECT * FROM 'vj_music_bands'");
	}


	/**
	 * Save application and update post.
	 *
	 * @param  Music_Band $application
	 *
	 * @return  Music_Band
	 * @throws \Exception
	 */
	public function save($application, $post)
	{
		$db_data = $this->get_db_data($application);

		$db_row = $this->get_db_row($application->id);

		if (!empty($db_row)) {
			// Update in the db
			$res = $this->db->update(
				$this->table_name,
				$db_data['values'],
				['id' => $application->id],
				$db_data['formats'],
				'%d'
			);

			// Check if updated
			if ($res === false) {
				throw new \Exception(' Music_Band UPDATE failed!');
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
				throw new \Exception(' Music_Band CREATE failed!');
			}
		}

		$wp_post = $this->update_wp_post($application, $post);

		return $application;
	}

	/**
	 * @param  Music_Band $application
	 *
	 * @return array
	 */
	private function get_db_data($application)
	{
		$db_data = new Db_Data();

		$db_data->add_data('id', $application->id, '%d');
		$db_data->add_data('band_name', $application->band_name, '%s');
		$db_data->add_data('phone', $application->phone, '%s');
		$db_data->add_data('email', $application->email, '%s');
		$db_data->add_data('city', $application->city, '%s');
		$db_data->add_data('country', $application->country, '%s');
		$db_data->add_data('available_locations', $application->available_locations, '%s');
		$db_data->add_data('members', $application->members, '%s');
		$db_data->add_data('instruments', $application->instruments, '%s');
		$db_data->add_data('video_link', $application->video_link, '%s');
		$db_data->add_data('genres', $application->genres, '%s');
		$db_data->add_data('female_vocal', $application->female_vocal, '%s');
		$db_data->add_data('male_vocal', $application->male_vocal, '%s');
		$db_data->add_data('website', $application->website, '%s');
		$db_data->add_data('instagram', $application->instagram, '%s');
		$db_data->add_data('facebook', $application->facebook, '%s');
		$db_data->add_data('tags', $application->tags, '%s');
		$db_data->add_data('year_of_foundation', $application->year_of_foundation, '%s');
		$db_data->add_data('short_description', $application->short_description, '%s');
		$db_data->add_data('granted', $application->granted, '%s');
		$db_data->add_data('date_created', $application->date_created->format(DATE_ATOM), '%s');

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

	/**
	 * 
	 */
	private function update_wp_post($application, $post)
	{
		update_field(Music_Band::$PHONE, $application->phone, $post->ID);
		update_field(Music_Band::$EMAIL, $application->email, $post->ID);
		update_field(Music_Band::$CITY, $application->city, $post->ID);
		update_field(Music_Band::$COUNTRY, $application->country, $post->ID);
		update_field(Music_Band::$AVAILABLE_LOCATIONS, $application->available_locations, $post->ID);
		update_field(Music_Band::$MEMBERS, $application->members, $post->ID);
		update_field(Music_Band::$INSTRUMENTS, $application->instruments, $post->ID);
		update_field(Music_Band::$VIDEO_LINK, $application->video_link, $post->ID);
		update_field(Music_Band::$GENRES, $application->genres, $post->ID);
		update_field(Music_Band::$FEMALE_VOCAL, $application->female_vocal, $post->ID);
		update_field(Music_Band::$MALE_VOCAL, $application->male_vocal, $post->ID);
		update_field(Music_Band::$WEBSITE, $application->website, $post->ID);
		update_field(Music_Band::$INSTAGRAM, $application->instagram, $post->ID);
		update_field(Music_Band::$FACEBOOK, $application->facebook, $post->ID);
		update_field(Music_Band::$TAGS, $application->tags, $post->ID);
		update_field(Music_Band::$YEAR_OF_FOUNDATION, $application->year_of_foundation, $post->ID);
		
	}
}
