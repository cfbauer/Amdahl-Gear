<?php
/* ADD custom theme functions here  */

// Register Custom Post Type
function video_post_type() {

    $labels = array(
        'name'                  => _x( 'Videos', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Video', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Videos', 'text_domain' ),
        'name_admin_bar'        => __( 'Videos', 'text_domain' ),
        'archives'              => __( 'Video Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Video', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Video', 'text_domain' ),
        'description'           => __( 'Video embed', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', ),
        'taxonomies'            => array( 'exercise_type' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'video', $args );

}
add_action( 'init', 'video_post_type', 0 );



/*
/ Creates Archive Page For Custom Fields
*/
// array of filters (field key => field name)
$GLOBALS['my_query_filters'] = array(
    'field_1'	=> 'muscle_group',
);


// action
add_action('pre_get_posts', 'my_pre_get_posts', 10, 1);

function my_pre_get_posts( $query ) {

    // bail early if is in admin
    if( is_admin() ) {
        return;
    }


    // get meta query
    $meta_query = $query->get('meta_query');


    // loop over filters
    foreach( $GLOBALS['my_query_filters'] as $key => $name ) {

        // continue if not found in url
        if( empty($_GET[ $name ]) ) {
            continue;
        }


        // get the value for this filter
        // eg: http://www.website.com/events?city=melbourne,sydney
        $value = explode(',', $_GET[ $name ]);


        // append meta query
        $meta_query[] = array(
            'key'		=> $name,
            'value'		=> $value,
            'compare'	=> 'IN',
        );

    }


    // update meta query
    $query->set('meta_query', $meta_query);

}
