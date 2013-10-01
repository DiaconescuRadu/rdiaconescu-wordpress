<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  My Archive
 *
 * @file           full-width-page.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */

get_header(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(window).load(function(){ $('#cat_div').masonry({
                 columnWidth: 325,
                 itemSelector: '.cat_container'
            }); });
    });
</script>

<?php
?>

<div id="main" class="site-main">
    <div id="primary" class="content-area">
		<div id="content" class="site-content html_carousel" role="main">
            </div><!--cat_div-->
            <div class="horizontalRule"></div>

            <?php
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 500));
            
            echo 'found ' . $blog_query->post_count;
            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                    $currentMonth = get_the_date('m');
                    if (empty($prevMonth) || $currentMonth != $prevMonth) {
                        echo '<h5>' . get_the_date( 'M') . ' ' . get_the_date('Y') . '</h5>';
                    } 
                    echo '<a href=' . get_permaling . '<p>' . get_the_title() . '</p></a>'; 
                    $prevMonth = $currentMonth;
                endwhile;
            endif;
               
            wp_reset_postdata();
            ?>  
</div>
</div>
</div><!-- end of #content-full -->

<?php get_footer(); ?>
