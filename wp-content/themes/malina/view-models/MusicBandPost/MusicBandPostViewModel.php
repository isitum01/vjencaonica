<?php

namespace Vjencaonica;

/**
 * Class MusicBandPostViewModel
 * @package VegetaBio
 */
class MusicBandPostViewModel extends BaseViewModel
{
    /**
     * @var string
     */
    public $postTitle;
    /**
     * @var string
     */
    public $postContent;

    public $shortDescription;
    public $phone;
    public $email;
    public $city;
    public $country;
    public $availableLocations;
    public $members;
    public $instruments;
    public $videoLink;
    public $genres;
    public $femaleVocal;
    public $maleVocal;
    public $website;
    public $instagram;
    public $facebook;
    public $tags;
    public $yearOfFoundation;
    public $granted;

    /**
     * MusicBandPostViewModel constructor.
     *
     * @param \WP_Post $wp_post
     */
    public function __construct(\WP_Post $wp_post)
    {
        parent::__construct();

        $this->postTitle            = $wp_post->post_title;
        $this->postContent          = apply_filters('the_content', $wp_post->post_content);
        $this->shortDescription     = $wp_post->post_excerpt;
        $this->phone                = get_field(Music_Band::$PHONE, $wp_post->ID);
        $this->email                = get_field(Music_Band::$EMAIL, $wp_post->ID);
        $this->city                 = get_field(Music_Band::$CITY, $wp_post->ID);
        $this->country              = get_field(Music_Band::$COUNTRY, $wp_post->ID);
        $this->availableLocations   = get_field(Music_Band::$AVAILABLE_LOCATIONS, $wp_post->ID);
        $this->members              = get_field(Music_Band::$MEMBERS, $wp_post->ID);
        $this->instruments          = get_field(Music_Band::$INSTRUMENTS, $wp_post->ID);
        $this->videoLink            = get_field(Music_Band::$VIDEO_LINK, $wp_post->ID);
        $this->genres               = get_field(Music_Band::$GENRES, $wp_post->ID);
        $this->femaleVocal          = get_field(Music_Band::$FEMALE_VOCAL, $wp_post->ID);
        $this->maleVocal            = get_field(Music_Band::$MALE_VOCAL, $wp_post->ID);
        $this->website              = get_field(Music_Band::$WEBSITE, $wp_post->ID);
        $this->instagram            = get_field(Music_Band::$INSTAGRAM, $wp_post->ID);
        $this->facebook             = get_field(Music_Band::$FACEBOOK, $wp_post->ID);
        $this->tags                 = get_field(Music_Band::$TAGS, $wp_post->ID);
        $this->yearOfFoundation     = get_field(Music_Band::$YEAR_OF_FOUNDATION, $wp_post->ID);
        $this->granted              = get_field(Music_Band::$GRANTED, $wp_post->ID);
    }
}
