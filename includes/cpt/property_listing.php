<?
function register_custom_post_type() {

    // Labels for the Custom Post Type UI in WordPress admin.
    $labels = array(
        'name'                  => 'Properties',
        'singular_name'         => 'Property',
        'menu_name'             => 'Properties',
        'name_admin_bar'        => 'Property',
        'archives'              => 'Property Archives',
        'attributes'            => 'Property Attributes',
        'parent_item_colon'     => 'Parent Property:',
        'all_items'             => 'All Properties',
        'add_new_item'          => 'Add New Property',
        'add_new'               => 'Add New',
        'new_item'              => 'New Property',
        'edit_item'             => 'Edit Property',
        'update_item'           => 'Update Property',
        'view_item'             => 'View Property',
        'view_items'            => 'View Properties',
        'search_items'          => 'Search Property',
        'not_found'             => 'No properties found',
        'not_found_in_trash'    => 'No properties found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into property',
        'uploaded_to_this_item' => 'Uploaded to this property',
        'items_list'            => 'Properties list',
        'items_list_navigation' => 'Properties list navigation',
        'filter_items_list'     => 'Filter properties list',
    );

    $args = array(
        'label'                 => 'Property',
        'description'           => 'Custom Post Type for managing properties.',
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-admin-multisite',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array( 'slug' => 'property' ),
    );




    register_post_type('property', $args);
}

add_action('init', 'register_custom_post_type', 0);



/**
 * Register the 'property_type' Custom Taxonomy.
 *
 * This function defines the labels and arguments for the 'property_type'
 * taxonomy and associates it with the 'property' custom post type.
 */
function register_property_type_taxonomy() {
    // Labels for the Custom Taxonomy UI in WordPress admin.
    $labels = array(
        'name'                       => 'Property Types',
        'singular_name'              => 'Property Type',
        'menu_name'                  => 'Property Types',
        'all_items'                  => 'All Property Types',
        'parent_item'                => 'Parent Property Type',
        'parent_item_colon'          => 'Parent Property Type:',
        'new_item_name'              => 'New Property Type Name',
        'add_new_item'               => 'Add New Property Type',
        'edit_item'                  => 'Edit Property Type',
        'update_item'                => 'Update Property Type',
        'view_item'                  => 'View Property Type',
        'separate_items_with_commas' => 'Separate property types with commas',
        'add_or_remove_items'        => 'Add or remove property types',
        'choose_from_most_used'      => 'Choose from the most used',
        'popular_items'              => 'Popular Property Types',
        'search_items'               => 'Search Property Types',
        'not_found'                  => 'Not Found',
        'no_terms'                   => 'No property types',
        'items_list'                 => 'Property types list',
        'items_list_navigation'      => 'Property types list navigation',
    );

    // Arguments for registering the Custom Taxonomy.
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'property-type', 'hierarchical' => true ),
    );

    // Register the custom taxonomy and associate it with the 'property' Custom Post Type.
    register_taxonomy( 'property_type', array( 'property' ), $args );
}
add_action( 'init', 'register_property_type_taxonomy', 0 );


?>