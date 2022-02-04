<?php

namespace Vjencaonica;

/**
 * Class SinglePostViewModel
 * @package VegetaBio
 */
class SinglePostViewModel extends BaseViewModel
{
	/**
	 * @var string
	 */
	public $postTitle;
	/**
	 * @var string
	 */
	public $postContent;

	/**
	 * SinglePostViewModel constructor.
	 *
	 * @param \WP_Post $wp_post
	 */
	public function __construct(\WP_Post $wp_post)
	{
		parent::__construct();

		$this->postTitle   = $wp_post->post_title;
		$this->postContent = apply_filters('the_content', $wp_post->post_content);
	}
}
