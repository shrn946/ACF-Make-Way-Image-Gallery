<?php
/*
Plugin Name: ACF Make Way Image Gallery 
Description: Plugin to add Make Way Image Gallery with ACF. Shortcode [acf_gallery]
Version: 1.0
Author: Hassan
*/

// Enqueue the stylesheet
function make_way_image_grid_enqueue_styles() {
    wp_enqueue_style('make-way-image-grid-style', plugins_url('style.css', __FILE__));
}

// Hook the function to the 'wp_enqueue_scripts' action
add_action('wp_enqueue_scripts', 'make_way_image_grid_enqueue_styles');


// functions.php or your custom plugin file

function display_acf_gallery() {
    // Replace 'gallery' with your actual ACF field name
    $gallery_images = get_field('gallery');

    if ($gallery_images) {
        echo '<section class="grid">';
        
        foreach ($gallery_images as $image) {
            echo '<div class="img">';
            echo '<button>';
            echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
            echo '</button>';
            echo '</div>';
        }

        echo '</section>';
    }
}

// Shortcode for usage in WordPress posts or pages
function acf_gallery_shortcode() {
    ob_start();
    display_acf_gallery();
    return ob_get_clean();
}
add_shortcode('acf_gallery', 'acf_gallery_shortcode');
