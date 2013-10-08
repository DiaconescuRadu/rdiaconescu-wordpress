<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Pages Template
 *
   Template Name:  Gallery Main
 *
 * @file           page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2013 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
get_header(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(window).load(function(){ $('#masonry_container').masonry({
                 columnWidth: 620,
                 itemSelector: '.img_container',
                 isFitWidth: true
            }); });
    });

</script>

<div id="main" class="site-main">
    <div id="primary" class="content-area">
		<div id="content" class="site-content site_content" role="main">
            <i><h3 class="text-center">Best photos of the past years.</h3></i>
            <div class="horizontalRule"></div>
            <div class="masonry_container masonry" id="masonry_container">
                    <!-- Montains -->
                    <div class="img_container">
                        <a href="mountains" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h5 class="center_title">Mountains</h5>
                    </div>
                    <!-- Climbing -->
                    <div class="img_container">
                        <a href="climbing" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h5 class="center_title">Climbing</h5>
                    </div>
                    <!-- Bikeing -->
                    <div class="img_container">
                        <a href="biking" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h5 class="center_title">Biking</h5>
                    </div>
                    <!-- People -->
                    <div class="img_container">
                        <a href="people" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h5 class="center_title">Cities</h5>
                    </div>
            </div><!-- end of .col-940 -->
        </div><!-- end of #content -->
    </div><!-- end of #content -->
</div><!-- end of #content -->
<?php get_footer(); ?>
