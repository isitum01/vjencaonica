<?php
/**
 * Created by PhpStorm.
 * User: Mateo Mlikota
 * Date: 7. 2. 2021.
 * Time: 17:16
 */

namespace Vjencaonica;

/**
 * Class Recipes_Service
 * @package VegetaBio
 */
class Recipes_Service {
	/**
	 * @var Recipes_Repository
	 */
	private $recipe_repository;

	/**
	 * Recipes_Service constructor.
	 */
	public function __construct() {
		$this->recipe_repository = new Recipes_Repository();
	}

	/**
	 * Get recipe.
	 *
	 * @return null|Recipe_Dto
	 */
	public function get_recipe() {
		$wp_post = $this->recipe_repository->get_recipe();

		if ( empty( $wp_post ) ) {
			return null;
		}

		return new Recipe_Dto( $wp_post );
	}

	/**
	 * Get featured recipe.
	 *
	 * @return null|Recipe_Dto
	 */
	public function get_featured_recipe() {
		$wp_post = $this->recipe_repository->get_featured_recipe();
		
		if ( empty( $wp_post ) ) {
			return null;
		}
		
		// var_dump($wp_post[0]);

		return new Recipe_Dto( $wp_post[0] );
	}

	/**
	 * Get all recipes except featured recipe
	 * 
	 */
	public function get_all_recipes_except_featured(){
		$wp_posts = $this->recipe_repository->get_all_recipes_except_featured();
		
		if ( empty( $wp_posts ) ) {
			return [];
		}

		return array_map(function ($wp_post) {
			return new Recipe_Dto($wp_post);
		}, $wp_posts);

	}
}