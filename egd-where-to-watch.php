<?php
/**
 * Plugin Name: EGD Where to Watch
 * Description: Adds custom ACF fields from "Where to Watch" in Single Movie Pages
 * Plugin URI: https://www.evilgeniusdevel.com
 * Version: 0.0.1
 * Author: Drew Wiltjer
 * Author URI: https://www.evilgeniusdvel.com
 * text-domain: egd-where-to-watch
 */

 if( ! defined( 'ABSPATH') ) exit; //exit if accessed directly

 function egd_where_to_watch_shortcode() {
    if(!class_exists('ACF')) {
        exit;
    }
    $html = "";

    if(have_rows('where_to_watch')) {
        $html .= '<div class="watch-table">';
        while (have_rows('where_to_watch')) {
            the_row();
            $html .= '<div class="watch-item">';
            //platform icon
            $html .= '<div class="platform-icon">';
            $platformIcon = get_sub_field('icon');
            $size = array('50', '50');
            $html .= wp_get_attachment_image($platformIcon, $size);
            $html .= '</div>';

            //platform name
            $html .= '<div class="platform-name">';
            $html .= get_sub_field('platform');
            $html .= '</div>';

            //movie cost
            $html .= '<div class="movie-cost">';
            $html .= get_sub_field('cost');
            $html .= '</div>';

            //movie link and medium
            $html .= '<div class="movie-link">';
            $html .= '<a href="' . get_sub_field('link') . '" target="_blank">';
            $html .= get_sub_field('medium');
            $html .= '</a>';
            $html .= '</div>';

            $html .= '</div>'; //end class watch-item
        }
        $html .= '</div>'; //end class watch-table
    }
    return $html;
 }

 add_shortcode('egd_where_to_watch', 'egd_where_to_watch_shortcode');