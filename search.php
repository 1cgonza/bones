<?php get_header(); ?>

<div id="content">

  <main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
    <h1 class="archive-title"><span>Search Results for:</span> <?php echo esc_attr( get_search_query() ); ?></h1>

    <?php
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
