<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

  <?php
  $postTitle      = get_the_title();
  $postURL        = get_the_permalink();
  $postDateFormat = 'F jS, Y';
  $postDate       = get_the_time($postDateFormat);
  $authorID       = get_the_author_meta('ID');
  $authorURL      = get_author_posts_url($authorID);
  $authorName     = get_the_author_meta('display_name');

  $postHeader = '<header class="article-header entry-header">';

    /*==========  CATEGORIES  ==========*/
    $postCategoriesArgs = array (
      'orderby'  => 'name',
      'order'    => 'ASC',
      'title_li' => '',
      'echo'     => 0
    );
    $postCategories = wp_list_categories($postCategoriesArgs);

    $postHeader .= '<ul class="post-categories">';
      $postHeader .= $postCategories;
    $postHeader .= '</ul>';

    /*==================================
    =            POST TITLE            =
    ==================================*/
    $postHeader .= '<h1 class="entry-title single-title" itemprop="headline" rel="bookmark">';
      if ( is_single() ) {
        $postHeader .= $postTitle;
      } else {
        $postHeader .= '<a href="' . $postURL . '" target="_self">';
          $postHeader .= $postTitle;
        $postHeader .= '</a>';
      }
    $postHeader .= '</h1>';
    /*-----  End of POST TITLE  ------*/

    /*============================
    =            META            =
    ============================*/
    $postHeader .= '<div class="post-meta">';

      /*==========  DATE  ==========*/
      $postHeader .= '<time class="entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . $postDate . '</time>';

      /*==========  AUTHOR  ==========*/
      $postHeader .= '<span class="by"> by </span>';
      $postHeader .= '<span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">';
        $postHeader .= '<a href="' . $authorURL . '">' . $authorName . '</a>';
      $postHeader .= '</span>';

    $postHeader .= '</div>';
    /*-----  End of META  ------*/

  $postHeader .= '</header>';

  echo $postHeader;

  ?>

  <section class="entry-content cf" itemprop="articleBody">
    <?php
    if ( is_search() || is_home() || is_archive() ) {
      the_excerpt();
    } else {
      the_content();
    }
    ?>
  </section>

  <footer class="article-footer">
    <?php
    the_tags( '<p class="tags">', '<span>|</span> ', '</p>' );

    /*========================================
    =            POSTS NAVIGATION            =
    ========================================*/
    $previousPost = get_previous_post();
    $nextPost = get_next_post();

    if ( is_single() ) {
      $postsNav = '<nav class="posts-navigation cf" role="navigation">';

      if ($previousPost) {
        $postsNav .= '<span class="previous-post left">&larr; ';
          $postsNav .= '<a href="' . $previousPost->guid . '" rel="prev">' . $previousPost->post_title . '</a>';
        $postsNav .= '</span>';
      }

      if ($nextPost) {
        $postsNav .= '<span class="next-post right">';
          $postsNav .= '<a href="' . $nextPost->guid . '" rel="next">' . $nextPost->post_title . '</a>';
        $postsNav .= ' &rarr;</span>';
      }

      $postsNav .= '</nav>';

      echo $postsNav;

    }
    /*-----  End of POSTS NAVIGATION  ------*/
    ?>
  </footer>

  <?php comments_template(); ?>

</article>
