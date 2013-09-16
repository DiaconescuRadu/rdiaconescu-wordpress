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
                 columnWidth: 420,
                 itemSelector: '.cat_container'
            }); });
        $(window).load(function(){ $('#img_container').masonry({
             columnWidth: 420,
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

    $activitiesName = "ACTIVITIES";
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
    $locationsName = "LOCATIONS";
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
    $ratingsName = "RATINGS";
    $ratingCats = array(
        1 => $slugCats["one-star"],
        2 => $slugCats["two-stars"],
        3 => $slugCats["three-stars"],
        4 => $slugCats["epic"],
        #5 => $slugCats["concursuri"],
        #6 => $slugCats["cicloturism"],
    );


?>


<div id="content-full" class="grid col-940">
    <div class="searchform">
	<form method="get" id="searchform" action="<?php echo home_url( '/explore/' ); ?>">
		<input type="text" class="field" name="search" id="s" placeholder="<?php esc_attr_e('search here &hellip;', 'responsive'); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'responsive'); ?>"  />
	</form>
    </div><!--end of the searchformdiv-->

    <?php 
	global $wp_query;

    $search = get_query_var('search');
    $cat_filter = get_query_var('categories');
    $mode = get_query_var('mode');
    $cat_name = str_replace('/', ',', get_query_var('categories'));

    if (empty($mode)) {
        $mode = 'int';
    }

    /* constructing the link url */

    if ( !empty($search)) {
        $search_string = $search . '/';
    } else {
        $search_string = $search;
    }

    $new_url = home_url( 'explore' ) . '/mode/' . $mode . '/search/' . $search_string . 'categories/' . $cat_filter;

#    echo '<pre>';
#    print_r($new_url);
#    echo '<br>';
#    print_r(str_replace( 'mode/int' , 'mode/reu' ,$new_url));
#    echo '<br>';
#     print_r($search);
#    echo '<br>';
#    print_r($cat_filter);
#    echo '</pre>';
    
    /* adding two headings for the mode */
    echo '<div class="searchmode">';
    echo '<a href=' . str_replace( 'mode/reu' , 'mode/int' ,$new_url) . '>' . '<h5>Mode = INT </h5>' . '</a>';
    echo '</div><!--end of the searchmode-->';
    echo '<div class="searchmode">';
    echo '<a href=' . str_replace( 'mode/int' , 'mode/reu' ,$new_url) . '>' . '<h5>Mode = REU </h5>' . '</a>';
    echo '</div><!--end of the searchmode-->';


    echo '<div class="grid col-940 cat_div" id="cat_div">';
        list_category_array($activitiesName, $activitiesCats, $new_url);
        list_category_array($locationsName, $locationCats, $new_url);
        list_category_array($ratingsName, $ratingCats, $new_url);
	echo '</div><!-- end of .col-940 -->';


    $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'category_name' => $cat_name, 'search' => $search));
	$temp_query = $wp_query;
	$wp_query = null;
	$wp_query = $blog_query;
    
    echo '<h3>Found ' . $blog_query->found_posts . '</h3>';

	if ( $blog_query->have_posts() ) :

        echo '<div class="grid col-940 tile_cont" id="img_container">';
			while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
				?>

            <?php
            echo '<div class="tile_img_container">';
            echo '<a href="' . get_permalink() . '" title="Look '.get_the_title().'" >';
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail();
            }
            else {
                echo '<div class="placeholder">';
                echo '</div>';
            }
            echo '</a>';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '</div>';
            ?>
		<?php 
		endwhile;
        echo '</div><!-- end of .col-940 -->';

        if (  $wp_query->max_num_pages > 1 ) : 
			?>
			<div class="navigation">
				<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ), $wp_query->max_num_pages ); ?></div>
				<div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ), $wp_query->max_num_pages ); ?></div>
			</div><!-- end of .navigation -->
			<?php 
		endif;

	else : 

		get_template_part( 'loop-no-posts' ); 

	endif; 
	$wp_query = $temp_query;
	wp_reset_postdata();
	?>  


<!-- adding some test checkboxes -->
<!--form action="">
    <input type="checkbox" name="vehicle" value="Bike">I have a bike<br>
    <input type="checkbox" name="vehicle" value="Car">I have a car 
</form-->
      
<!--?php
$categories = get_categories();
$separator = ' ';
$output = '';
if($categories){
    foreach($categories as $category) {
        $output .= '<p><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></p>'.$separator;
    }
echo trim($output, $separator);
}
?-->



</div><!-- end of #content-full -->

<?php get_footer(); ?>
