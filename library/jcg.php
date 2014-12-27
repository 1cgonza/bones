<?php

function jcg_head_cleanup() {
  // category feeds
  remove_action('wp_head', 'feed_links_extra', 3);
  // post and comment feeds
  remove_action('wp_head', 'feed_links', 2);
  // EditURI link
  remove_action('wp_head', 'rsd_link');
  // windows live writer
  remove_action('wp_head', 'wlwmanifest_link');
  // previous link
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  // start link
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  // links for adjacent posts
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  // WP version
  remove_action('wp_head', 'wp_generator');
  // remove WP version from css
  add_filter('style_loader_src', 'bones_remove_wp_ver_css_js', 9999);
  // remove Wp version from scripts
  add_filter('script_loader_src', 'bones_remove_wp_ver_css_js', 9999);

}

// remove WP version from RSS
function jcg_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js($src) {
  if ( strpos($src, 'ver=') )
    $src = remove_query_arg('ver', $src);
  return $src;
}

/*==========  ENQUEUE STYLES AND SCRIPTS  ==========*/
function jcg_scripts_and_styles() {

  global $wp_styles;

  if ( !is_admin() ) {
    wp_register_script( 'jcg-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
    wp_register_style( 'jcg-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    wp_register_script( 'jcg-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array('jquery'), '', true );

    wp_enqueue_script('jcg-modernizr');
    wp_enqueue_style('jcg-stylesheet');

    wp_enqueue_script('jquery');
    wp_enqueue_script('jcg-js');
  }
}

/*=====================================
=            THEME SUPPORT            =
=====================================*/
function jcg_theme_support() {
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(125, 125, true);
  add_theme_support('automatic-feed-links');

  // output the following with HTML5 syntax.
  add_theme_support( 'html5', array('comment-form', 'search-form', 'gallery', 'caption') );

  add_theme_support('title-tag'); // New on WP 4.1

  /*==========  MENUS  ==========*/
  add_theme_support('menus');
  register_nav_menus(
    array(
      'main-nav' => 'The Main Menu'
    )
  );
}
/*-----  End of THEME SUPPORT  ------*/


/*=======================================
=            PAGE NAVIGATION            =
=======================================*/
function jcg_page_nav() {
  global $wp_query;
  $bignum = 999999999;

  if ( $wp_query->max_num_pages <= 1 ) {
    return;
  } else {
    $newNav = '<nav class="pagination">';
    $newNav .= paginate_links( array(
      'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $wp_query->max_num_pages,
      'prev_text' => '&larr;',
      'next_text' => '&rarr;',
      'type'      => 'list',
      'end_size'  => 3,
      'mid_size'  => 3
    ) );
    $newNav .= '</nav>';

    echo $newNav;
  }
}
/*-----  End of PAGE NAVIGATION  ------*/

function jcg_main_container_class() {
  $mainClass = 'm-100 t-100 d-80 ld-70 cf';
  if ( ! is_active_sidebar('main-sidebar') ) {
    $mainClass .= ' no-sidebar';
  }
  echo $mainClass;
}

/*==========  REMOVE <p> AROUND IMAGES  ==========*/
function jcg_filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*==========  REPLACE [...] FOR READ MORE TEXT  ==========*/
function jcg_excerpt_more($more) {
  global $post;
  return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="Read ' . esc_attr( get_the_title($post->ID) ) . '">' . 'Read more &raquo;</a>';
}

?>
