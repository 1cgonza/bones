<?php get_header(); ?>

<div id="content">

  <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <h1 class="archive-title"><?php post_type_archive_title(); ?></h1>

    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      get_template_part( 'content', get_post_type() );
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
