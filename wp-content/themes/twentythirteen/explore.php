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
                 columnWidth: 300,
                 itemSelector: '.cat_container'
            }); });
        $(window).load(function(){ $('#img_container').masonry({
             columnWidth: 415,
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

    if(ICL_LANGUAGE_CODE == 'ro'){
        $needleString = "Usurand gasirea acului in carul cu fan.";
        $activitiesName = "Activitati";
        $reunionString = "Reuniune"; 
        $intersectionString = "Intersectie"; 
        $entryFoundString = " de jurnale gasite"; 
        $exploreUrl = home_url( 'explore');
         /* chunk for activities */
        $activitiesCats = array(
            1 => $slugCats["alpinism"],
            2 => $slugCats["alergat"],
            3 => $slugCats["bike-climb-bike"],
            4 => $slugCats["escalada"],
            5 => $slugCats["catarat"],
            6 => $slugCats["schi-de-tura"],
            7 => $slugCats["schi-de-partie"],
            8 => $slugCats["drumetii"],
            9 => $slugCats["cicloturism"],
            #9 => $slugCats["concursuri"],
            #10 => $slugCats["cicloturism"],
        );

        /* chunk for places */
        $locationsName = "Locuri";
        $locationCats = array(
            1 => $slugCats["bucegi"],
            2 => $slugCats["piatra-craiului"],
            3 => $slugCats["fagaras"],
            4 => $slugCats["postavaru"],
            5 => $slugCats["retezat"],
            6 => $slugCats["germania"],
            7 => $slugCats["ciucas"],
            8 => $slugCats["baiului"],
            #9 => $slugCats["concursuri"],
            #10 => $slugCats["cicloturism"],
        );

        /* chunk for rating */
        $ratingsName = "Rating";
        $ratingCats = array(
            1 => $slugCats["plimbare-prin-parc"],
            2 => $slugCats["interesant-si-provocator"],
            3 => $slugCats["aventuros"],
            4 => $slugCats["epic"],
            #5 => $slugCats["concursuri"],
            #6 => $slugCats["cicloturism"],
        );
    }
    if(ICL_LANGUAGE_CODE == 'en'){
        $needleString = "Making the needle in the haystack easier to find.";
        $searchString = "Search Mode";
        $reunionString = "Reunion"; 
        $intersectionString = "Intersection"; 
        $entryFoundString = " entries found"; 
        $activitiesName = "Activities";
        $exploreUrl = home_url( 'en/explore-en');
        /* chunk for activities */
        $activitiesCats = array(
            1 => $slugCats["alpinism-en"],
            2 => $slugCats["running"],
            3 => $slugCats["bike-touring"],
            4 => $slugCats["climbing"],
            5 => $slugCats["ski-touring"],
            6 => $slugCats["ski"],
            7 => $slugCats["trekking"],
            #9 => $slugCats["concursuri"],
            #10 => $slugCats["cicloturism"],
        );

        /* chunk for places */
        $locationsName = "Places";
        $locationCats = array(
            1 => $slugCats["bucegi"],
            2 => $slugCats["piatra-craiului"],
            3 => $slugCats["fagaras"],
            4 => $slugCats["postavaru"],
            5 => $slugCats["retezat"],
            6 => $slugCats["germany"],
            7 => $slugCats["ciucas"],
            8 => $slugCats["baiului"],
            #9 => $slugCats["concursuri"],
            #10 => $slugCats["cicloturism"],
        );

        /* chunk for rating */
        $ratingsName = "Rating";
        $ratingCats = array(
            1 => $slugCats["a-walk-in-the-park"],
            2 => $slugCats["interesting-challenging"],
            3 => $slugCats["adventurous"],
            4 => $slugCats["epic"],
            #5 => $slugCats["concursuri"],
            #6 => $slugCats["cicloturism"],
        );
    }
?>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
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
            /* removing page from the $cat_name */
            $cat_name = preg_replace("/,page,.*/", "" , $cat_name);
         }

        /* mode processing, and setting the class properly */
        if (empty($mode)) {
            $mode = 'int';
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

        $new_url = $exploreUrl . '/mode/' . $mode . '/search/' . $search_string . 'categories/' . $cat_filter;

        #print_r($cat_filter);
        #print_r(str_replace( 'mode/int' , 'mode/reu' ,$new_url));
        #echo '<br>';
        #print_r($search);
        #echo '<br>';
        #print_r($cat_filter);
        #echo '</pre>';
        
        /* adding two headings for the mode */
        ?>
        <i><h3 class="text-center"><?php echo $needleString ?></h3></i>
        <div class="horizontalRule site_content"></div>
        <div class="cat_div site_content" id="cat_div">
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
                
                <i><h4 class="text-center"><?php echo $searchString?></h4></i>

                <a href="<?php echo str_replace( 'mode/int' , 'mode/reu' ,$new_url)?>">
                <div class="circle_container">
                    <div id="circle" class="red" style="left:30px;opacity:1"></div>
                    <div id="circle" class="red" style="left:65px;opacity:1"></div>
                    <div class="circle-text" style="top:70px;left:45px"><i><p><?php echo $reunionString?></p></i></div>
                </div>
                </a>
                
                <a href="<?php echo str_replace( 'mode/reu' , 'mode/int' ,$new_url)?>">
                <div class="circle_container">
                    <div id="circle" class="red" style="left:30px;"></div>
                    <div id="circle" class="red" style="left:65px;"></div>
                    <div class="circle-text" style="top:70px;left:30px"><i><p><?php echo $intersectionString?></p></i></div>
                </div>
                </a><br>
            </div>

        <?php
            list_category_array($activitiesName, $activitiesCats, $new_url);
            list_category_array($locationsName, $locationCats, $new_url);
            list_category_array($ratingsName, $ratingCats, $new_url);
        ?>
        </div><!--cat_div-->
        <div class="horizontalRule site_content"></div>

        <?php
        if (strpos($mode , 'reu') !== false || empty($cat_name)) {
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category_name' => $cat_name, 's' => $search));
        } else {
            $cat_id_array = get_category_and($cat_name);
            $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'posts_per_page' => 9, 'category__and' => $cat_id_array, 'search' => $search));
        }
         
        if ($blog_query->found_posts !== 0) {
            echo '<i><h3 class="text-center">' . $blog_query->found_posts . $entryFoundString . '</h3></i>';
            list_posts($blog_query);
        } else {
            echo '<i><h3 class="text-center">Found no results, extend your search</h3></i>';
        }
        wp_reset_postdata();
        ?>  
</div><!-- end of #content content -->
</div><!-- end of #content primary -->

<?php get_footer(); ?>
