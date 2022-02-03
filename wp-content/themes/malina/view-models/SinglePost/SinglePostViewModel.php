<?php

namespace Vjencaonica;

/**
 * Class SinglePostViewModel
 * @package VegetaBio
 */
class SinglePostViewModel extends BaseViewModel {
	/**
	 * @var string
	 */
	public $postTitle;
	/**
	 * @var string
	 */
	public $postContent;
	/**
	 * @var Recipe_Dto
	 */
	public $featuredRecipe;

	/**
	 * SinglePostViewModel constructor.
	 *
	 * @param \WP_Post $wp_post
	 */
	public function __construct( \WP_Post $wp_post ) {
		parent::__construct();

		$recipe_service 	= new Recipes_Service();

		$this->postTitle   = $wp_post->post_title;
		$this->postContent = apply_filters( 'the_content', $wp_post->post_content );
		$this->featuredRecipe		= $recipe_service->get_all_recipes_except_featured();
		var_dump($this->featuredRecipe[2]->level);
	}


}
