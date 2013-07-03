<?php get_header(); ?>

  <?php if ( '' != locate_template( 'loop-'.get_post_type().'.php' ) ) // Check if themplate exists esle get default posts loop
      {
         get_template_part( 'loop', get_post_type() );
      } else {
          get_template_part( 'loop', 'post' );
      }
  ?>

<?php get_footer(); ?>