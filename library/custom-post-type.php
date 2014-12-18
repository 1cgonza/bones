<?php

add_action( 'after_switch_theme', 'jcg_flush_rewrite_rules' );
function jcg_flush_rewrite_rules() {
  flush_rewrite_rules();
}

// The custom dashicons are at: https://developer.wordpress.org/resource/dashicons/
function create_post_types() {
  register_post_type( 'custom_type',
    array(
      'labels' => array(
        'name'               => 'Custom Types',
        'singular_name'      => 'Custom Post',
        'all_items'          => 'All Custom Posts',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Custom Type',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Post Types',
        'new_item'           => 'New Post Type',
        'view_item'          => 'View Post Type',
        'search_items'       => 'Search Post Type',
        'not_found'          => 'Nothing found in the Database.',
        'not_found_in_trash' => 'Nothing found in Trash',
        'parent_item_colon'  => ''
    ),
    'description'         => '',
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'query_var'           => true,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-admin-generic',
    'rewrite'             => array( 'slug' => 'custom_type', 'with_front' => false ),
    'has_archive'         => 'custom-type',
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
    'taxonomies'          => array('category', 'post_tag')
    )
  );
}
add_action( 'init', 'create_post_types');

?>
