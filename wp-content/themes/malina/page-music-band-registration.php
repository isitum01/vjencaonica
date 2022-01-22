<?php 
/*
Template Name: Music Band Registration
*/

use Vjencaonica\MusicBandRegistrationPageViewModel;

$view_model = [
    'jsRoute'   => 'musicBandRegistration',
    'bodyClass' => 'music-band-registration',
    'vm'        => new MusicBandRegistrationPageViewModel(get_post())
];

$timber->render('pages/music-band-registration-page/music-band-registration-page.twig', $view_model);