<?php get_header(); ?>

<div id="content">

  <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <?php
    /*=====================================
    =            ARCHIVE TITLE            =
    =====================================*/
    $archiveTitle = '<h1 class="archive-title">';

    if ( is_category() ) {
      $archiveTitle .= single_cat_title('', false);
    } elseif ( is_tag() ) {
      $archiveTitle .= single_tag_title('', false);
    } elseif ( is_author() ) {
      global $post;
      $authorID = $post->post_author;
      $archiveTitle .= 'Posts by: ' . get_the_author_meta( 'display_name', $authorID );
    } elseif ( is_day() ) {
      $archiveTitle .= get_the_time('l, F j, Y');
    } elseif ( is_month() ) {
      $archiveTitle .= get_the_time('F Y');
    } elseif( is_year() ) {
      $archiveTitle .= get_the_time('Y');
    }

    $archiveTitle .= '</h1>';

    echo $archiveTitle;
    /*-----  End of ARCHIVE TITLE  ------*/

    if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
      endwhile;
      jcg_page_nav();
      else :
      get_template_part( 'content', 'error');
    endif;
    ?>

  </main>

  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
