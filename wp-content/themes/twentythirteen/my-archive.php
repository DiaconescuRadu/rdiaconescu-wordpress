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
        $(window).load(function(){ $('#month_div').masonry({
                 columnWidth: 400,
                 itemSelector: '.month_container'
            }); });
    });
</script>

<?php
    if(ICL_LANGUAGE_CODE == 'en'){
        $adventures = ' adventures, ';
        $daysOutside = ' days spent outside';
    }
    if(ICL_LANGUAGE_CODE == 'ro'){
        $adventures = 'de aventuri, ';
        $daysOutside = ' zile petrecute afara';
    }
?>


<div id="main" class="site-main">
    <div id="primary" class="content-area">
		<div id="content" class="site-content site_content" role="main">
            <?php
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 500));
            echo '<i><h3 class="text-center"> ' . $blog_query->post_count . $adventures . $blog_query->post_count * 2 . $daysOutside . '</h3></i>';
            echo '<div class="horizontalRule"></div>';
            echo '<div id="month_div">';
            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
                    $currentMonth = get_the_date('m');
                    if (empty($prevMonth) || $currentMonth != $prevMonth) {
                        /* ending of the previous list */
                        if (!empty($prevMonth)) {
                            $endingUL = '</ul></div>';
                        }
                        echo $endingUL . '<div class="month_container"><h5 class="ul_heading">' . get_the_date( 'F') . ', ' . get_the_date('Y') . '</h5><ul class="no_style">';
                    } 
                    echo '<li>' .  '<a href="' . get_permalink() . '">' . get_the_date('j, M - ') .get_the_title() . '</a></li>'; 
                    $prevMonth = $currentMonth;
                endwhile;
                /* ending of the last list */
                echo '</ul></div>';
            endif;
            echo '</div>';
               
            wp_reset_postdata();
            ?>  
</div>
</div>
</div><!-- end of #content-full -->

<?php get_footer(); ?>
