<?php get_header(); ?>

<div id="content">

  <main id="main" class="<?php jcg_main_container_class(); ?>" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
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
