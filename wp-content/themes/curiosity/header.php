<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @file      header.php
 * @package   curiosity
 * @author    Sami Ch.
 * @link 	  http://gazpo.com
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>


<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php 
if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		
wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="header">
	<div class="full-wrap">
	<div class="inner-wrap">
		<?php
		/**
		* Check if the logo image is set in theme options.
		*/
		?>
		<div class="logo-wrap">
			<div class="logo">
				<?php if (curiosity_get_option( 'logo_url' )) { ?>
					<h1>
						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
							<img src="<?php echo curiosity_get_option( 'logo_url' ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
					</h1>	
				<?php } else {?>
					<h1 class="site-title">
						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
							<?php bloginfo('name'); ?>
						</a>
					</h1> 
					<h3>
						<?php bloginfo('description'); ?>
					</h3>
				<?php } ?>	
			</div>	<!-- /logo -->
		
			<?php if (curiosity_get_option( 'ad468' )) {?>
				<div class="ad468">	
					<?php echo curiosity_get_option( 'ad468' ); ?>	
				</div>
			<?php } ?>
		
		</div><!-- /logo-wrap -->
	</div>  <!-- /inner-wrap -->
	</div> <!-- /full-wrap -->
	<div class="inner-wrap">
	<div id="nav">	
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'curiosity_menu_fallback',) ); ?>		
	</div>		
		<div class="clear"></div>
	</div>  <!-- /inner-wrap -->
	
</div> <!-- /header -->

<?php

			//show on homepage only
			if (is_home() && $paged < 2 ){

				//include slider
				if ( curiosity_get_option( 'show_slider' ) == 1 ) {
					get_template_part('includes/slider'); 
				}
				
				if ( curiosity_get_option( 'show_carousel' ) == 1 ){
					get_template_part('includes/carousel'); 
				}
				
			}
?>

<div id="container" class="hfeed">
<div id="content-container">

