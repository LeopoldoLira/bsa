<?
defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'property-search',
    get_template_directory_uri() . '/blocks/property-listing/property-listing.js',
    [],
    filemtime(get_template_directory() . '/blocks/property-listing/property-listing.js'),
    true
  );

  // Retrieve ACF values
  $manual = get_field('manual_properties');
  $mode = get_field('show_mode');
  $manual_ids = is_array($manual) ? wp_list_pluck($manual, 'ID') : [];

  wp_localize_script('property-search', 'propertySearch', [
    'ajaxurl' => admin_url('admin-ajax.php'),
    'manual_ids' => $manual_ids,
    'mode' => $mode,
  ]);
});

function ajax_property_search() {
  $search = sanitize_text_field($_GET['search'] ?? '');
  $term   = sanitize_text_field($_GET['term'] ?? '');
  $manual_ids = isset($_GET['manual_ids']) ? array_map('intval', $_GET['manual_ids']) : [];

  $args = [
    'post_type' => 'property',
    'posts_per_page' => -1,
    's' => $search,
  ];

  if (!empty($term)) {
    $args['tax_query'] = [[
      'taxonomy' => 'property_type',
      'field' => 'slug',
      'terms' => $term
    ]];
  }

  if (!empty($manual_ids)) {
    $args['post__in'] = $manual_ids;
    $args['orderby'] = 'post__in';
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) :
    echo '<div class="property-grid">';
    while ($query->have_posts()) : $query->the_post();
      get_template_part('includes/components/property_card', null, ['post_id' => get_the_ID()]);
    endwhile;
    echo '</div>';
  else :
    echo '<p>No properties found.</p>';
  endif;

  wp_reset_postdata();
  wp_die();
}


add_action('wp_ajax_property_search', 'ajax_property_search');
add_action('wp_ajax_nopriv_property_search', 'ajax_property_search');

?>