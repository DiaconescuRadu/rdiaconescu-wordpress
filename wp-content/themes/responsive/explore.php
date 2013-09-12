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

<div id="content-full" class="grid col-940">
	<form method="get" id="searchform" action="<?php echo home_url( '/explore/' ); ?>">
		<input type="text" class="field" name="search" id="s" placeholder="<?php esc_attr_e('search here &hellip;', 'responsive'); ?>" />
		<input type="submit" class="submit" name="category" id="searchsubmit" value="<?php esc_attr_e('Go', 'responsive'); ?>"  />
	</form>

    <form action="">
        <label href="asd"><input type="checkbox" name="filter" value="alpinism">Alpinism</label><br>
        <input type="checkbox" name="filter" value="alergat">Alergat<br> 
        <input type="checkbox" name="filter" value="cu-bicla" checked href="<?php echo home_url( '/explore/search/asd/' ); ?>">Cu Bicla<br>
        <input type="checkbox" name="filter" value="catarat">Catarat<br> 
    </form>

    <?php 
	global $wp_query;

    $search = get_query_var('search');
    $cat_name = str_replace('/', ',', get_query_var('category'));

    echo '<pre>';
    print_r($cat_name);
    echo '</pre>';
    

    $blog_query = new WP_Query( array( 'post_type' => 'post', 'paged' => $paged , 'category_name' => $cat_name, 'search' => $search));
	$temp_query = $wp_query;
	$wp_query = null;
	$wp_query = $blog_query;

/* will need to delete this */

	if ( $blog_query->have_posts() ) :

			while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
				?>

            <?php
            echo '<div class="tile_img_container">';
            echo '<a href="' . get_permalink() . '" title="Look '.get_the_title().'" >';
            echo get_the_post_thumbnail();
            echo '</a>';
            echo '<h2>' . get_the_title() . '</h2>';
            echo '</div>';
            ?>
		<?php 
		endwhile;

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
