<?php

require_once get_template_directory() . '/includes/ajax/property-filters.php';

add_action('acf/init', function () {
    acf_register_block_type([
        'name'              => 'hero-block',
        'title'             => __('Hero Block'),
        'description'       => __('A hero section with heading, subheading, background, and CTA.'),
        'render_template'   => get_template_directory() . '/blocks/hero/hero-template.php',
        'category'          => 'formatting',
        'icon'              => 'cover-image',
        'mode'              => 'edit',
        'supports'          => ['align' => false]
    ]);
});


// Enqueue block styles
function bsa_enqueue_block_styles() {
    wp_enqueue_style(
        'bsa-blocks-style',
        get_template_directory_uri() . '/includes/styles/css/main.min.css',
        [],
        filemtime(get_template_directory() . '/includes/styles/css/main.min.css')
    );

}
add_action('wp_enqueue_scripts', 'bsa_enqueue_block_styles');


require_once get_template_directory() . '/includes/cpt/property_listing.php';


// blocks/property-listing/property-listing.php
add_action('acf/init', function () {
  acf_register_block_type([
    'name'              => 'property-listing',
    'title'             => 'Property Listing Block',
    'description'       => 'Displays a grid of properties with optional manual selection.',
    'render_template'   => get_template_directory() . '/blocks/property-listing/property-listing-template.php',
    'category'          => 'widgets',
    'icon'              => 'admin-home',
    'keywords'          => ['property', 'listing', 'grid'],
    'mode'              => 'edit'
  ]);
});



function bsa_enqueue_fonts() {
  wp_enqueue_style(
    'bsa-inter-font',
    'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
    false
  );
}
add_action('wp_enqueue_scripts', 'bsa_enqueue_fonts');


