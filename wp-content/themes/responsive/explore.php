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


<div id="content-full" class="grid col-940">
	<form method="get" id="searchform" action="<?php echo home_url( '/explore/' ); ?>">
		<input type="text" class="field" name="search" id="s" placeholder="<?php esc_attr_e('search here &hellip;', 'responsive'); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e('Go', 'responsive'); ?>"  />
	</form>

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

    echo '<pre>';
    print_r($new_url);
    echo '<br>';
    print_r(str_replace( 'mode/int' , 'mode/reu' ,$new_url));
    echo '<br>';
     print_r($search);
    echo '<br>';
    print_r($cat_filter);
    echo '</pre>';
    
    /* adding two headings for the mode */
    echo '<a href=' . str_replace( 'mode/reu' , 'mode/int' ,$new_url) . '>' . '<h3>Mode = INT </h3>' . '</a>';
    echo '<a href=' . str_replace( 'mode/int' , 'mode/reu' ,$new_url) . '>' . '<h3>Mode = REU </h3>' . '</a>';


    $categories = get_categories();
    /* adding two headings for the mode */
    echo '<pre>';
    print_r($categories);
    echo '</pre>';
    

    $categories_chunks = array_chunk($categories , 10);

    echo '<div class="grid col-940 cat_div" id="cat_div">';
    foreach($categories_chunks as $category_chunk) {
        echo '<div class="cat_container">';
        echo '<ul>';
            foreach($category_chunk as $category) {
                if (strpos($cat_filter , $category->slug) !== false) {
                    echo '<u>' . '<li><a href=' . $new_url . '>' . $category->name . '</li>' . '</u>';
                } else {
                   echo '<li><a href=' . $new_url . '/' . $category->slug . '>' . $category->name . '(' . $category
->count . ')' . '</li>';
                };
            }
        echo '</ul>';
        echo '</div><!-- end of .col-940 -->';
    }
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
