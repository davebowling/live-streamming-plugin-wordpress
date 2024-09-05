<?php
/*
Plugin Name: Custom Live Stream Plugin
Description: Plugin to enable live streaming on your WordPress site.
Version: 1.0
Author: Dave Bowling
*/

// Ensure WordPress context
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Enqueue the necessary video player scripts and styles
function add_video_player_assets() {
    wp_enqueue_script('video-js', 'https://vjs.zencdn.net/7.11.4/video.min.js', array(), null, true);
    wp_enqueue_style('video-js-css', 'https://vjs.zencdn.net/7.11.4/video-js.min.css');
}
add_action('wp_enqueue_scripts', 'add_video_player_assets');

// Shortcode to embed the video player
function live_stream_shortcode($atts) {
    $atts = shortcode_atts(array(
        'stream_url' => '',
    ), $atts, 'live_stream');

    return '<video id="my_video" class="video-js vjs-default-skin" controls preload="auto" width="640" height="360">
                <source src="' . esc_url($atts['stream_url']) . '" type="application/x-mpegURL">
            </video>';
}
add_shortcode('live_stream', 'live_stream_shortcode');
