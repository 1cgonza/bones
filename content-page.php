<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

  <header class="article-header">
    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
  </header>

  <section class="entry-content cf" itemprop="articleBody">
    <?php the_content(); ?>
  </section>

  <footer class="article-footer cf">

  </footer>

  <?php comments_template(); ?>

</article>
