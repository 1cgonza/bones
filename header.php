<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
    <meta name="msapplication-TileColor" content="#5698c1">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">
    <meta name="theme-color" content="#3f647b">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

    <div id="container">
      <header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
        <p id="site-name" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
        <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
          <?php
          wp_nav_menu(array(
            'container'       => false,
            'container_class' => 'menu cf',
            'menu'            => 'The Main Menu',
            'menu_class'      => 'nav top-nav cf',
            'theme_location'  => 'main-nav',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'depth'           => 0,
            'fallback_cb'     => ''
          ));
          ?>
        </nav>
      </header>
