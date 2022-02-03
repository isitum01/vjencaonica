<?php

/**
 * Created by PhpStorm.
 * User: Mateo Mlikota
 * Date: 7. 2. 2021.
 * Time: 17:02
 */

namespace Vjencaonica;

/**
 * Class Recipes_Repository
 * @package VegetaBio
 */
class Recipes_Repository
{
	/**
	 * Returns first recipe.
	 *
	 * @return \WP_Post
	 */
	// public function get_recipe() {
	// 	$wp_posts = get_posts( [
	// 		'post_type'      => Recipe::$POST_TYPE,
	// 		'post_status'    => 'publish',
	// 		'posts_per_page' => 1
	// 	] );

	// 	$wp_post = ! ( empty( $wp_posts ) ) ? current( $wp_posts ) : null;
	// 	return $wp_post;
	// }


	public function get_recipe()
	{
		$wp_posts = get_posts([
			'post_type'      => Recipe::$POST_TYPE,
			'post_status'    => 'publish',
			'posts_per_page' => 1
		]);

		$wp_post = !(empty($wp_posts)) ? current($wp_posts) : null;
		return $wp_post;
	}

	/**
	 * Gets the featured recipe.
	 *
	 * @return mixed
	 */
	public function get_featured_recipe()
	{
		$front_page_id = (int) get_option('page_on_front');

		return get_field(Recipe::$FP_FEATURED_RECIPE, $front_page_id);
	}

	/**
	 * Gets all recipes except featured recipe
	 * 
	 */

	public function get_all_recipes_except_featured(){

		$featured_recipe = $this->get_featured_recipe();
		$featured_recipe_id = $featured_recipe[0]->ID; 

		$wp_posts = get_posts([
			'post_type' => Recipe::$POST_TYPE,
			'post_status' => 'publish',
			'numberposts' => -1,
			'post__not_in' => [ $featured_recipe_id ]
		   ]);
		   
		return $wp_posts;
	 }
}
