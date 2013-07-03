<?php

class my_wdg_social extends WP_Widget {
    function my_wdg_social()
    {    
        /* CONSTRUCTOR */
        $widget_ops = array(
            'classname' => 'widget_social',
            'description' => __( 'Social icons from your accounts' , 'myThemes' )
        );
        
	$this -> WP_Widget( 'my_wdg_social' , myTheme::group() . ' : ' . __( 'Social icons' , 'myThemes' ) , $widget_ops );
    }

    function widget( $args , $instance)
    {
        
        extract( $args , EXTR_SKIP );
        
        $vimeo      = empty( $instance[ 'vimeo' ] ) ? '' : esc_url( $instance[ 'vimeo' ] );
        $twitter    = empty( $instance[ 'twitter' ] ) ? '' : esc_url( $instance[ 'twitter' ] );
	$facebook   = empty( $instance[ 'facebook' ] ) ? '' : esc_url( $instance[ 'facebook' ] );
	
        $google     = empty( $instance[ 'google-plus' ] ) ? '' : esc_url( $instance[ 'google-plus' ] );
        $youtube    = empty( $instance[ 'youtube' ] ) ? '' : esc_url( $instance[ 'youtube' ] );
        $rss        = empty( $instance[ 'rss' ] ) ? 0 : (int)esc_attr( $instance[ 'rss' ] );
        
        echo $before_widget;
        
        echo '<div>';
        
        /* VIMEO */
        if( !empty( $vimeo ) )
            echo '<a href="' . $vimeo . '" class="vimeo" target="_blank"></a>';
        
        /* TWITTER */
        if( !empty( $twitter ) )
            echo '<a href="' . $twitter. '" class="twitter" target="_blank"></a>';
        
        /* FACEBOOK */
        if( !empty( $facebook ) )
            echo '<a href="' . $facebook . '" class="facebook" target="_blank"></a>';
        
        /* GOOGLE PLUS */
        if( !empty( $google ) )
            echo '<a href="' . $google . '" class="google-plus" target="_blank"></a>';
        
        /* YOUTUBE */
        if( !empty( $youtube ) )
            echo '<a href="' . $youtube . '" class="youtube" target="_blank"></a>';
        
        /* RSS */
        if( $rss ){
            echo '<a href="'; bloginfo( 'rss2_url' ); echo '" class="rss" target="_blank"></a>';
        }
        
        echo '<div class="clear"></div>';
        echo '</div>';
        
        echo $after_widget;
    }

    function update( $new_instance , $old_instance )
    {
        /* SAVE WIDGETS */
        $instance                   = $old_instance;
        $instance[ 'vimeo' ]        = esc_url( $new_instance[ 'vimeo' ] );
        $instance[ 'twitter' ]      = esc_url( $new_instance[ 'twitter' ] );
        $instance[ 'facebook' ]     = esc_url( $new_instance[ 'facebook' ] );
        $instance[ 'google-plus' ]  = esc_url( $new_instance[ 'google-plus' ] );
        $instance[ 'youtube' ]      = esc_url( $new_instance[ 'youtube' ] );
        $instance[ 'rss' ]          = esc_attr( $new_instance[ 'rss' ] );
        return $instance;
    }

    function form( $instance )
    {
        
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'vimeo' => '',
                'twitter' => '',
                'facebook' => '',
                'google-plus' => '',
                'youtube' => '',
                'rss' => '1' 
            )
        );
?>

        <p>
            <label for="<?php echo $this -> get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo profile URL' , 'myThemes' )?>:
                <input class="widefat" id="<?php echo $this -> get_field_id( 'vimeo' ); ?>" name="<?php echo $this -> get_field_name( 'vimeo' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'vimeo' ] ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter profile URL' , 'myThemes' ) ?>:
                <input class="widefat" id="<?php echo $this -> get_field_id( 'twitter' ); ?>" name="<?php echo $this -> get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'twitter' ] ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook profile or page ( URL )' , 'myThemes' ) ?>: 
                <input class="widefat" id="<?php echo $this -> get_field_id( 'facebook' ); ?>" name="<?php echo $this -> get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'facebook' ] ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id( 'google-plus' ); ?>"><?php _e( 'Google + profile URL' , 'myThemes' )?>:
                <input class="widefat" id="<?php echo $this -> get_field_id( 'google-plus' ); ?>" name="<?php echo $this -> get_field_name( 'google-plus' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'google-plus' ] ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube profile URL' , 'myThemes' )?>:
                <input class="widefat" id="<?php echo $this -> get_field_id( 'youtube' ); ?>" name="<?php echo $this -> get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'youtube' ] ); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id( 'rss' ); ?>"><?php _e( 'Show RSS icon' , 'myThemes' )?>: 
                <input id="<?php echo $this -> get_field_id( 'rss' ); ?>" name="<?php echo $this -> get_field_name( 'rss' ); ?>" type="checkbox" value="1" <?php checked( '1' , esc_attr( $instance[ 'rss' ] ) ) ?>/>
            </label>
        </p>
<?php
    }
}
?>