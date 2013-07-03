<?php
class my_wdg_posts extends WP_Widget {
    
    var $ln = 80;
    
    function my_wdg_posts() {
        
        /* INIT CONSTRUCTOR */
	$widget_ops = array(
            'classname' => 'related-articles', 
            'description' => __( 'Related post ( use only for single template )' , 'myThemes' ) 
        );
        
        $this -> WP_Widget( 'my_wdg_posts' , myTheme::group() . ' : ' . __( 'Related Posts' , 'myThemes' ) , $widget_ops );
    }

    function widget( $args, $instance )
    {
        global $post;
        
        /* PRINT THE WIDGET */
        extract( $args , EXTR_SKIP );
        
        $title  = !empty( $instance[ 'title' ] )? $instance[ 'title' ] : '';
        $type   = !empty( $instance[ 'type' ] )? $instance[ 'type' ] : '';
        $number = !empty( $instance[ 'number' ] )? (int)$instance[ 'number' ] : 5;
        
        $terms  = wp_get_post_terms( $post -> ID , $type );
        $terms_ = array();
        
        if( empty( $terms ) ){
            return;
        }
        
        foreach( $terms as $t ){
            array_push( $terms_ , $t -> term_id );
        }
        
        $type_terms = array(
            'post_tag' => 'tag_in',
            'category' => 'category_in'
        );
        
        $args  = array( $type_terms[ $type ] => $terms_ , 'post__not_in' => array( $post -> ID ),  'posts_per_page' => $number, 'orderby' => 'rand' );
    
        $query = new WP_Query( $args );
        
        if( empty( $query -> posts ) ){
            return;
        }
            
        echo $before_widget;

        if( !empty( $title ) )
            echo $before_title . $title . $after_title;

        echo '<div class="list-view small-icons">';

        foreach( $query -> posts as $p ){

            echo '<article>';

            if( has_post_thumbnail( $p -> ID ) ){
                echo '<div class="thumbnail">';
                echo '<a href="' . get_permalink( $p -> ID ). '" alt="' . esc_attr( $p -> post_title ) . '">' ;
                echo get_the_post_thumbnail( $p -> ID , array( 80 , 80 ) );
                echo '</a>';
                echo '</div>';
            }else{
                echo '<div class="thumbnail">';
                echo '<a href="' . get_permalink( $p -> ID ). '" title="' . esc_attr( $p -> post_title ) . '">' ;
                echo '<img src="' . get_template_directory_uri() . '/media/images/noimage.png" alt="' . esc_attr( $p -> post_title ) . '"  width="80">';
                echo '</a>';
                echo '</div>';
            }

            /* TITLE */
            echo '<h5>';
            echo '<a href="' . get_permalink( $p -> ID ) . '" title="' . esc_attr( $p -> post_title ) . '">' . $p -> post_title . '</a>';
            echo '</h5>';

            /* META */
            echo '<div class="meta">';

            echo '<time datetime="' . get_post_time( 'Y-m-d', false , $p -> ID  ) . '"><i class="icon-date"></i> ' . get_post_time( get_option( 'date_format' ), false , $p -> ID  ) . '</time>';
            echo '<span class="commens">';

            if ( 'open' == $p -> comment_status ){
                echo '<a href="' . get_permalink( $p -> ID ) . '#comments" title="' . __( 'comments for' , 'myThemes' ) . ' ' . esc_attr( $p -> post_title ) . '"><i class="icon-comments"></i> ';
                echo $p -> comment_count; 
                echo '</a>';
            } 
            else{
                 echo '<i class="icon-comments"></i> ' . __( 'Off' , 'myThemes' );
            }

            echo '</span>';
            echo '</div>';
            echo '<p>';
            $excerpt = stripslashes( strip_tags( strip_shortcodes( esc_attr( $p -> post_excerpt ) ) ) );
            $content = stripslashes( strip_tags( strip_shortcodes( esc_attr( $p -> post_content ) ) ) );
            if( !empty( $excerpt ) ){
                echo mb_substr( $excerpt , 0 , $this -> ln ) . '..';
            }
            else{
                echo mb_substr( $content , 0 , $this -> ln ) . '..';
            }
            echo '</p>';
            echo '<div class="clear"></div>';
            echo '</article>';
        }

        echo '</div>';
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        
        $instance = $old_instance;
        $instance[ 'title' ] = esc_attr( $new_instance[ 'title' ] );
        $instance[ 'type' ] = esc_attr( $new_instance[ 'type' ] );
        $instance[ 'number' ] = (int)esc_attr( $new_instance[ 'number' ] );
        return $instance;
    }

    function form( $instance )
    {
        /* PRINT WIDGET FORM */
	$instance = wp_parse_args( (array) $instance, array( 
            'title' => '',
            'type' => 'post_tag',
            'number' => 5,
        ));
        
        $title  = $instance[ 'title' ];
        $type   = $instance[ 'type' ];
        $number = $instance[ 'number' ];
        
        /* WIDGET TITLE */
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'title' ) . '">' . __( 'Title' , 'myThemes' ) . ':';
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'title' ) . '" name="' . $this -> get_field_name( 'title' ) . '" value="' . $title . '">';
        echo '</label>';
        echo '</p>';
        
        /* POSTS PRINT METHOD */
        $values = array(
            'category' => __( 'Categories' , 'myThemes' ),
            'post_tag' => __( 'Tags' , 'myThemes' )
        );
        
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'type' ) . '">' . __( 'Related by' , 'myThemes' ) . ':';
        echo '<select class="widefat" id="' . $this -> get_field_id( 'type' ) . '" name="' . $this -> get_field_name( 'type' ) . '">';
        foreach( $values as $v => $val ){
            echo '<option value="' . $v . '" ' . selected( $type , esc_attr( $v ) , false ) . '>' . $val . '</option>';
        }
        echo '</select>';
        echo '</label>';
        echo '</p>';
        
        /* POSTS NUMBER */
        echo '<p>';
        echo '<label for="' . $this -> get_field_id( 'number' ) . '">' . __( 'Posts Count' , 'myThemes' );
        echo '<input type="text" class="widefat" id="' . $this -> get_field_id( 'number' ) . '" name="' . $this -> get_field_name( 'number' ) . '" value="' . $number . '">';
        echo '</label>';
        echo '</p>';
    }
}
?>