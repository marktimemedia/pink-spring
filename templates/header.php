<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <?php wp_head(); ?>

    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
</head>
<body <?php body_class( get_theme_mod('mtm_body_style') ); ?>>
<div class="wrapper" role="document">
    <header class="header-main">
      <a class="screen-reader-text skip-link" href="#content">Skip to content</a>
        <div class="header--quicklinks">
          <div class="header--quicklinks-inner">
            <nav aria-label="Quicklinks" class="nav-quicklinks" role="navigation">
                <?php
                if ( has_nav_menu( 'quicklink_navigation' ) ) :
                    wp_nav_menu(array( 'theme_location' => 'quicklink_navigation', 'menu_class' => 'quicklinks-menu' ) );
                endif;
                ?>
            </nav>
            <?php echo mtm_get_social_media(); ?>
            <?php echo mtm_get_phone_number(); ?>
            <?php spring_search_bar(); ?>
          </div>
        </div>
        <div class="header--inner">
            <section class="open-button-wrapper">
                <button aria-label="Open Menu" id="openMainMenu" class="open-main-menu open-button"><span>Open Main Menu</span></button>
                <?php echo spring_sidebar_button(); ?>
            </section>
            <nav aria-label="Primary" class="nav-main" role="navigation">
                <?php
                if ( has_nav_menu( 'primary_navigation' ) ) :
                    wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'nav-main--menu' ) );
                endif;
                ?>
                <button aria-label="Close Menu" id="closeSidebar"> × </button>
            </nav>

            <h1 class="header--blog-name">
                <?php the_mtm_header_logo(); ?>
                <?php the_mtm_mobile_logo(); ?>
            </h1>
            <div class="header--extra-text">
                <?php the_mtm_header_text(); ?>
            </div>
        </div>
    </header>
