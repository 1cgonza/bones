<?php
require_once( 'library/jcg.php' );
require_once( 'library/admin.php' );

function jcg_init() {
  // Load editor-style.css
  add_editor_style();
  require_once( 'library/custom-post-type.php' );
  add_action( 'init', 'jcg_head_cleanup' );
  // remove WP version from RSS
  add_filter( 'the_generator', 'jcg_rss_version' );
  add_action( 'wp_enqueue_scripts', 'jcg_scripts_and_styles', 999 );

  // Add the theme supports
  jcg_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'jcg_register_sidebars' );
  add_filter( 'the_content', 'jcg_filter_ptags_on_images' );
  add_filter( 'excerpt_more', 'jcg_excerpt_more' );
}
add_action( 'after_setup_theme', 'jcg_init' );


/*==========  OEMBED DEFAULT  ==========*/
if ( ! isset( $content_width ) ) {
  $content_width = 640;
}

/*==========  THUMBNAILS  ==========*/
add_image_size( 'thumb-600x150', 600, 150, true );
add_image_size( 'thumb-300x100', 300, 100, true );

add_filter( 'image_size_names_choose', 'jcg_custom_image_sizes' );

function jcg_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'thumb-600x150' => '600px by 150px',
        'thumb-300x100' => '300px by 100px',
    ) );
}

/*==========  SIDEBARS  ==========*/
function jcg_register_sidebars() {
  register_sidebar(array(
    'id'            => 'main-sidebar',
    'name'          => 'Main Sidebar',
    'description'   => 'The main sidebar.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  ));
}


/*======================================
=            COMMENT LAYOUT            =
======================================*/
function jcg_comments( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;

  $commClasses     = comment_class( 'cf', $comment->comment_ID, $comment->comment_post_ID, false );
  $commAuthorEmail = get_comment_author_email();
  $gravatarData    = md5($commAuthorEmail);
  $noImgSrc        = get_template_directory_uri() . '/library/images/nothing.gif';
  $commentLink     = htmlspecialchars( get_comment_link( $comment->comment_ID ) );
  $commDate        = new DateTime($comment->comment_date);
  $commDateFormat  = 'F jS, Y';
  $commAuthorURL   = get_comment_author_link();
  $commEditURL     = get_edit_comment_link();

  $jcgComment = '<div id="comment-' . $comment->comment_ID . '" ' . $commClasses . '>';

    $jcgComment .= '<article class="cf">';

      $jcgComment .= '<header class="comment-author vcard">';

        /*==========  GRAVATAR  ==========*/
        $jcgComment .= '<img data-gravatar="http://www.gravatar.com/avatar/' . $gravatarData . '?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="' . $noImgSrc . '" />';

        /*==========  AUTHOR  ==========*/
        $jcgComment .= '<a class="comment-edit-link" href="' . $commEditURL . '" target="_self">(Edit)</a>';
        $jcgComment .= '<cite class="fn">' . $commAuthorURL . '</cite>';
        // printf( '<cite class="fn"></cite> %2$s', , edit_comment_link('(Edit)','  ','') );

        /*==========  TIMESTAMP  ==========*/
        $jcgComment .= '<time datetime="' . $commDate->format('Y-m-j') . '">';
          $jcgComment .= '<a href="' . $commentLink . '">' . $commDate->format($commDateFormat) . '</a>';
        $jcgComment .= '</time>';

      $jcgComment .= '</header>';

      /*==========  WAITING MODERATION  ==========*/
      if ($comment->comment_approved == '0') {
        $jcgComment .= '<div class="alert alert-info">';
          $jcgComment .= '<p>Your comment is awaiting moderation.</p>';
        $jcgComment .= '</div>';
      }

      /*==========  COMMENT CONTENT  ==========*/
      $jcgComment .= '<section class="comment_content cf">';
        $jcgComment .= $comment->comment_content;
      $jcgComment .= '</section>';

      /*==========  REPLY BUTTON  ==========*/
      $replyArgs = array(
        'depth'     => $depth,
        'max_depth' => $args['max_depth']
      );
      $jcgComment .= get_comment_reply_link( array_merge($args, $replyArgs) );

    $jcgComment .= '</article>';

  // WP closes this div. (If you add the closing tag the HTML structure breaks)

  echo $jcgComment;
}
/*-----  End of COMMENT LAYOUT  ------*/

/*==========  EXTERNAL FONTS  ==========*/
function jcg_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
}
add_action('wp_enqueue_scripts', 'jcg_fonts');

?>
