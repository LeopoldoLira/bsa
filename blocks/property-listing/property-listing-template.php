<?php
$taxonomy = 'property_type';
$terms = get_terms([
  'taxonomy' => $taxonomy,
  'hide_empty' => false
]);

$mode = get_field('show_mode');
$manual = get_field('manual_properties');
$manual_ids = is_array($manual) ? wp_list_pluck($manual, 'ID') : [];

$args = [
  'post_type' => 'property',
  'posts_per_page' => -1,
];

if ($mode === 'Manual Select' && !empty($manual_ids)) {
  $args['post__in'] = $manual_ids;
  $args['orderby'] = 'post__in';
}

$query = new WP_Query($args);
?>

<main
  class="property-listing-block"
  data-mode="<?= esc_attr($mode); ?>"
  data-manual="<?= esc_attr(json_encode($manual_ids)); ?>"
>

<div class='property-heading'>
    <h1>Property Listings</h1>
</div>

    <div class='property-filter'>
        <div class='property-select'>
            <h3>Category</h3>
            <select id="property-taxonomy-filter">
            <option value="">Please Select</option>
            <?php foreach ($terms as $term): ?>
                <option value="<?= esc_attr($term->slug); ?>"><?= esc_html($term->name); ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div class='property-search'>
            <span><img src='/wp-content/themes/bsaproperty/includes/images/search-icon.png' /><input type="text" id="property-search" placeholder="Search" /></span>
        </div>
    </div>

  <div id="property-grid">
    <?php if ($query->have_posts()): ?>
      <div class="property-grid">
        <?php while ($query->have_posts()): $query->the_post(); ?>
          <?php
            get_template_part('includes/components/property_card', null, [
              'post_id' => get_the_ID()
            ]);
          ?>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p>No properties found.</p>
    <?php endif; ?>
  </div>

  <div class='property-pagination'>
        <div class='property-pagination__element'>
            <a href='#'>←</a>
        </div>
        <div class='property-pagination__element active'>
            <a href='#'>01</a>
        </div>
        <div class='property-pagination__element mobile'>
            <a href='#'>02</a>
        </div>
        <div class='property-pagination__element mobile'>
            <a href='#'>03</a>
        </div>
        <div class='property-pagination__elements'>
            <a href='#'>...</a>
        </div>
        <div class='property-pagination__element'>
            <a href='#'>30</a>
        </div>
        
        <div class='property-pagination__element'>
            <a href='#'>→</a>
        </div>
  </div>
</main>
