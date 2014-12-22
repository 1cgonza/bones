<?php
if ( post_password_required() ) {
  return;
}
if ( have_comments() ) :
  $commArgs = array(
    'style'             => 'div',
    'short_ping'        => true,
    'avatar_size'       => 40,
    'callback'          => 'jcg_comments',
    'type'              => 'all',
    'reply_text'        => 'Reply',
    'page'              => '',
    'per_page'          => '',
    'reverse_top_level' => null,
    'reverse_children'  => '',
    'echo'              => false
  );
  $commNumber     = get_comments_number();
  $commPagesCount = get_comment_pages_count();

  if ($commNumber == 0) {
    $commTitle = 'No Comments';
  } elseif ($commNumber > 1) {
    $commTitle = $commNumber . ' Comments';
  } else {
    $commTitle = '1 Comment';
  }

  $comm = '<h3 id="comments-title">' . $commTitle . '</h3>';

  $comm .= '<section class="commentlist">';
    $comm .= wp_list_comments($commArgs);
  $comm .= '</section>';

  echo $comm;

  if ( $commPagesCount > 1 && get_option( 'page_comments' ) ) {
    $commNav = '<nav class="navigation comment-navigation" role="navigation">';
      $commNav .= '<span class="comment-nav-prev">';
        $commNav .= get_previous_comments_link('&larr; Previous Comments');
      $commNav .= '</span>';

      $commNav .= '<span class="comment-nav-next">';
        $commNav .= get_next_comments_link('More Comments &rarr;');
      $commNav .= '</span>';
    $commNav .= '</nav>';

    echo $commNav;
  }

  if ( ! comments_open() ) {
    echo '<p class="no-comments">Comments are closed.</p>';
  }

endif;

comment_form();

?>
