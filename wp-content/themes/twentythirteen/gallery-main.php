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
		<div id="content" class="site-content" role="main">
            <p> this is where the data is beeing displayed </p>
            <div class="masonry_container masonry" id="masonry_container">
                    <!-- Montains -->
                    <div class="img_container">
                        <a href="mountains" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h2 class="h2_img_container">Mountains</h2>
                    </div>
                    <!-- Climbing -->
                    <div class="img_container">
                        <a href="climbing" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h2 class="h2_img_container">Climbing</h2>
                    </div>
                    <!-- Bikeing -->
                    <div class="img_container">
                        <a href="biking" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h2 class="h2_img_container">Biking</h2>
                    </div>
                    <!-- People -->
                    <div class="img_container">
                        <a href="people" title="Look post title" >
                            <div class="placeholder_gallery">
                            </div>
                        </a>
                        <h2 class="h2_img_container">People</h2>
                    </div>
            </div><!-- end of .col-940 -->
        </div><!-- end of #content -->
    </div><!-- end of #content -->
</div><!-- end of #content -->
<?php get_footer(); ?>
