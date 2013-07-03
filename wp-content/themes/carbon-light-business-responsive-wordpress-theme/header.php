 <?php
/**
 * Carbon light is a fully responsive HTML5/CSS3  WordPress theme. Suitable for Business, Service, Portfolio websites. It has clean and minimalist design that is very easy to customize. It comes packed with a whole lot of code-snippets.
 *
 * @package WordPress
 * @subpackage Carbon Light
 */
?>
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8 ]> <html class="ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]> <html class="ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
  <meta name="description" content="<?php bloginfo( 'description' ); ?>">

  <?php wp_head(); ?>

  <!-- Includ Site Icon -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">

  <!-- WP Related -->
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

</head>
<body <?php body_class(); ?>>

<div> <!-- To activate boxed layout use <div id="boxed-layout"> -->
  <div id="page-content">
    <?php $check_page_header = ''; if ( get_post_meta( get_the_ID(), 'otw_head_title_setting', true) != '' ) { $check_page_header = ' nopheader'; } ?>
    <header id="top">
      <div class="otw-row otw-collapse<?php echo $check_page_header; ?>">
        <div class="otw-six otw-columns">
          <div id="otw-site-title">
            <h1><?php bloginfo( 'name' ); ?></h1>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/carbon-logo.png" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
          </div>
        </div>
        <div class="otw-eighteen otw-columns menu-wrapper">
            <nav id="primary">
              <?php if ( has_nav_menu( 'primary' )  ) { ?>
                  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'otw-primary-menu hide-for-small', 'walker' => new Menu_With_Description ) ); ?>
              <?php } else { ?>
                  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'otw-primary-menu hide-for-small simplemenu' ) ); ?>
              <?php } ?>
            </nav>
        </div>
      </div>
    </header>

    <?php if( $check_page_header == '' ) { ?>
    <div class="page-title-wrapper fixed-width">
      <div class="otw-row page-title">
        <div class="otw-eighteen otw-columns">
          <h1><?php otw_page_title(); ?></h1>
          <h2 class="subheader">
            <?php if( !is_archive() && !is_search() && !is_404() ) {
                if( is_home() ) { $page_id = get_option('page_for_posts'); } else { $page_id = get_the_ID(); }
                echo get_post_meta( $page_id, '_otw_meta_value_key', true); }
            ?>
          </h2>
          <div class="subtitle"></div>
        </div>
        <div class="otw-five otw-columns">
            <?php get_search_form(); ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="otw-row main-content">