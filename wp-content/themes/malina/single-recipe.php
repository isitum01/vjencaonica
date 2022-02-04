<?php
/**
 * The template for displaying all single posts and attachments
 */
// Create view model
$view_model = [
	'jsRoute' => 'singlePage',
	'bodyClass' => 'single-page',
	'vm' => new \Vjencaonica\SinglePostViewModel(get_post())
];

// Render view
$timber->render('pages/single-page/single-page.twig', $view_model);
