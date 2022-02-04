<?php
/**
 * The template for displaying all single music band and attachments
 */
// Create view model
$view_model = [
	'jsRoute' => 'musicBandSingle',
	'bodyClass' => 'music-band',
	'vm' => new \Vjencaonica\MusicBandPostViewModel(get_post())
];

// Render view
$timber->render('pages/music-band/music-band.twig', $view_model);
