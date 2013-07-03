<?php
/**
 * The template for displaying a blog layout for the homepage
 * * @package WordPress
 * @subpackage Jaguza
 * @since Jaguza 1.0.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'jaguza' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		</header>

		<div class="entry-content">
        <div class="homepagepreview">
        <a class="image append-mask" href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php echo jaguza_get_post_thumbnail('680','320' );	?>
         </a>
         </div><!--.homepagepreview-->
           <?php  the_excerpt(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'jaguza' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
        	<div class="the_date">
            <?php     echo get_the_date('M 	d'); ?>
            </div><!--.the_date-->
            <div class="home-post-meta">
            	<div class="home-author">
             		By <?php the_author_posts_link('namefl'); ?>
                </div><!--.home-author-->    
                <div class="home-category">
             		<?php the_category(', '); ?>
                </div><!--.home-category  -->  
                <div class="home-comments">
					<a href="<?php comments_link(); ?>"><?php comments_number('No comments', '1 comment', '% comments'); ?> &raquo;</a>
                 </div><!--.home-comments-->   
             </div><!--.home-post-meta-->
			<?php edit_post_link( __( 'Edit', 'jaguza' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->