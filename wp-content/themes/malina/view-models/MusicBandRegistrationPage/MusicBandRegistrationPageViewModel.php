<?php

namespace Vjencaonica;

/**
 * Class MusicBandRegistrationPageViewModel
 *
 * View model for music band registration page data.
 *
 * If the team-page has sections that need repositories, services etc. to
 * fetch its data, this view model should be constructed using the factory.
 *
 * @package Vjencaonica
 * @since 2.0.0
 */
class MusicBandRegistrationPageViewModel extends BaseViewModel {
	/**
	 * @var string
	 */
	public $content;

	/**
	 * MusicBandRegistrationPageViewModel constructor.
	 *
	 * @param $wp_post
	 */
	public function __construct($post) {
		parent::__construct();
		$this->content       = apply_filters('the_content', $post->post_content);
	}
}
