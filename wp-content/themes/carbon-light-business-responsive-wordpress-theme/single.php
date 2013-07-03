<?php get_header(); ?>


  <?php if ( '' != locate_template( 'content-'.get_post_type().'.php' ) ) // Check if themplate exists esle get default post content
      {
         get_template_part( 'content', get_post_type() );
      } else {
          get_template_part( 'content', 'post' );
      }
  ?>

<?php get_footer(); ?>