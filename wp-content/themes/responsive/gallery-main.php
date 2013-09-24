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
        $(window).load(function(){ $('#gallery_container').masonry({
                 columnWidth: 620,
                 itemSelector: '.img_container'
            }); });
    });

</script>


<div id="content" class="<?php echo implode( ' ', responsive_get_content_classes() ); ?>">
    <div class="grid col-940 tile_cont" id="gallery_container">
        <?php
                /* Image/container of the mountain */
                echo '<div class="img_container">';
                    echo '<a href="mountains" title="Look post title" >';
                        echo '<div class="placeholder_gallery">';
                        echo '</div>';
                    echo '</a>';
                    echo '<h2 class="h2_img_container">Mountains</h2>';
                echo '</div>';
                /* Image/container of the climbing */
                echo '<div class="img_container">';
                    echo '<a href="climbing" title="Look post title" >';
                        echo '<div class="placeholder_gallery">';
                        echo '</div>';
                    echo '</a>';
                    echo '<h2 class="h2_img_container">Climbing</h2>';
                echo '</div>';
                /* Image/container of the biking */
                echo '<div class="img_container">';
                    echo '<a href="biking" title="Look post title" >';
                        echo '<div class="placeholder_gallery">';
                        echo '</div>';
                    echo '</a>';
                    echo '<h2 class="h2_img_container">Biking</h2>';
                echo '</div>';
                /* Image/container of the people */
                echo '<div class="img_container">';
                    echo '<a href="people" title="Look post title" >';
                        echo '<div class="placeholder_gallery">';
                        echo '</div>';
                    echo '</a>';
                    echo '<h2 class="h2_img_container">People</h2>';
                echo '</div>';
        ?>
	</div><!-- end of .col-940 -->
</div><!-- end of #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
