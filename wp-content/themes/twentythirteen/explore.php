<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Explore
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
        $(window).load(function(){ $('#img_container').masonry({
             columnWidth: 433,
             itemSelector: '.tile_img_container'
        }); });
    });
</script>

<?php
    /* Hardcoded arrays / variables for this page */
    $categories = get_categories();
    $slugCats = array();

    foreach($categories as $cat) {
        $slugCats[$cat->slug] = $cat;
    }

    $activitiesName = "Activities";
    /* chunk for activities */
    $activitiesCats = array(
        1 => $slugCats["alpinism"],
        2 => $slugCats["alergat"],
        3 => $slugCats["cu-bicla"],
        4 => $slugCats["escalada"],
        5 => $slugCats["catarat"],
        6 => $slugCats["schi-de-tura"],
        7 => $slugCats["schi-de-partie"],
        8 => $slugCats["drumetii"],
        #9 => $slugCats["concursuri"],
        #10 => $slugCats["cicloturism"],
    );

    /* chunk for places */
    $locationsName = "Locations";
    $locationCats = array(
        1 => $slugCats["bucegi"],
        2 => $slugCats["baiului"],
        3 => $slugCats["fagaras"],
        4 => $slugCats["postavaru"],
        5 => $slugCats["retezat"],
        6 => $slugCats["mont-blanc"],
        7 => $slugCats["ciucas"],
        8 => $slugCats["drumetii"],
        #9 => $slugCats["concursuri"],
        #10 => $slugCats["cicloturism"],
    );

    /* chunk for rating */
    $ratingsName = "Ratings";
    $ratingCats = array(
        1 => $slugCats["one-star"],
        2 => $slugCats["two-stars"],
        3 => $slugCats["three-stars"],
        4 => $slugCats["epic"],
        #5 => $slugCats["concursuri"],
        #6 => $slugCats["cicloturism"],
    );


?>

<div id="main" class="site-main">
    <div id="primary" class="content-area">
		<div id="content" class="site-content site_content" role="main">
            <?php 
            global $wp_query;

            $search = get_query_var('search');
            $cat_filter = get_query_var('categories');
            $mode = get_query_var('mode');
            $cat_name = str_replace('/', ',', get_query_var('categories'));

            /* enhancement needed for older / newer posts , removing the paged/x from the end*/
            if (strpos($cat_filter , 'page') !== false) {
                $cat_array = explode ('/', $cat_filter);
                $paged = array_pop($cat_array);
                array_pop($cat_array);
                $cat_filter = implode ('/', $cat_array);
            }

            /* mode processing, and setting the class properly */
            if (empty($mode)) {
                $mode = 'reu';
            }
            /*
            if (strpos($mode , 'int') !== false) {
                $highlighted_intersection = "highlighted";
            } else {
                $highlighted_reunion = "highlighted";
            }
            */
            /* constructing the link url */

            if ( !empty($search)) {
                $search_string = $search . '/';
            } else {
                $search_string = $search;
            }

            $new_url = home_url( 'explore' ) . '/mode/' . $mode . '/search/' . $search_string . 'categories/' . $cat_filter;

            #echo '<pre>';
            #print_r($search);
            #echo '<br>';
            #print_r(str_replace( 'mode/int' , 'mode/reu' ,$new_url));
            #echo '<br>';
            #print_r($search);
            #echo '<br>';
            #print_r($cat_filter);
            #echo '</pre>';
            
            /* adding two headings for the mode */
            ?>
            <i><h3 class="text-center"> Making the needle in the haystack a bit easier to find. </h3></i>
            <div class="horizontalRule"></div>
            <div class="cat_div" id="cat_div">
                <div class="cat_container tweaking">
                    <div class="searchform div-center">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/explore/' ); ?>">
                        <label>
                            <span class="screen-reader-text">Search for:</span>
                            <input type="search" class="search-field" placeholder="Search …" value="" name="search" title="Search for:" />
                        </label>
                        <input type="submit" class="search-submit" value="Search" />
                    </form>
                    </div><!--end of the searchformdiv-->
                    
                    <i><h4 class="text-center"> Search mode </h4></i>

                    <a href="<?php echo str_replace( 'mode/int' , 'mode/reu' ,$new_url)?>">
                    <div class="circle_container">
                        <div id="circle" class="red" style="left:30px;opacity:1"></div>
                        <div id="circle" class="red" style="left:65px;opacity:1"></div>
                        <div class="circle-text" style="top:70px;left:45px"><i><p>Reunion</p></i></div>
                    </div>
                    </a>
                    
                    <a href="<?php echo str_replace( 'mode/reu' , 'mode/int' ,$new_url)?>">
                    <div class="circle_container">
                        <div id="circle" class="red" style="left:30px;"></div>
                        <div id="circle" class="red" style="left:65px;"></div>
                        <div class="circle-text" style="top:70px;left:30px"><i><p>Intersection</p></i></div>
                    </div>
                    </a><br>
                </div>

            <?php
                list_category_array($activitiesName, $activitiesCats, $new_url);
                list_category_array($locationsName, $locationCats, $new_url);
                list_category_array($ratingsName, $ratingCats, $new_url);
            ?>
            </div><!--cat_div-->
            <div class="horizontalRule"></div>

            <?php
            if (strpos($mode , 'reu') !== false || empty($cat_name)) {
                $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category_name' => $cat_name, 'search' => $search));
            } else {
                $cat_id_array = get_category_and($cat_name);
                $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category__and' => $cat_id_array, 'search' => $search));
            }
            
            if ($blog_query->found_posts !== 0) {
                list_posts($blog_query);
            } else {
                echo '<i><h3 class="text-center">Found no results, extend your search</h3></i>';
            }
            wp_reset_postdata();
            ?>  
</div>
</div>
</div><!-- end of #content-full -->

<?php get_footer(); ?>
