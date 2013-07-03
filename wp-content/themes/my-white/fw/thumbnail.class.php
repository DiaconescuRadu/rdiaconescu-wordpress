<?php
    class thumbnail{
        static $sizes = array(
            '1/4' => array( 220 , 999 ),
            '1/3' => array( 300 , 999 ),
            '1/2' => array( 440 , 999 ),
            '2/4' => array( 440 , 999 ),  
            '2/3' => array( 640 , 999 ),
            '3/4' => array( 680 , 999 ),
            '1'   => array( 920 , 999 ),
            '1/1' => array( 920 , 999 ),
        );
        
        static $currSize;
        
        function blogView( $template  , $post , $catID = null )
        {
            global $myLayout;
            
            if( has_post_thumbnail( $post->ID ) ) {
				
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ), 'full' );
				
                echo '<div class="blog-view-thumbnail post-thumbnail">';
				echo '<a href="' . $src[ 0 ] .'" rel="prettyPhoto">';
				echo '<div class="zoom"></div>';
				echo get_the_post_thumbnail( $post -> ID , 'single_' .  $myLayout -> width );
				echo '</a>';
                echo '</div><div class="clearfix"></div>';
				
            }
        }
        
        function listView( $template  , $post , $catID = null  )
        {
            if( true ){ /// todo : IF DISPLAY THUMBNAIL
                if( has_post_thumbnail( $post->ID ) ){
                    echo '<div class="list-view-thumbnail">';
                    echo '<span class="format"></span>';
                    echo '<div class="author">';
                    echo myTheme::gravatar( $post->ID , 30 );
                    echo '<a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' , $post->post_author ) . '</a>';
                    echo '</div>';
                    echo get_the_post_thumbnail( $post->ID , self::$currSize );
                    echo '</div><div class="clearfix"></div>';
                }
            }
        }
        
        function gridView( $template  , $post , $catID = null )
        {
            if( true ){ /// todo : if show thumbnail  = 
                if( has_post_thumbnail( $post->ID ) ){
                    echo '<div class="blog-view-thumbnail">';
                    echo '<span class="format"></span>';
                    echo '<div class="author">';
                    echo myTheme::gravatar( $post->ID , 30 );
                    echo '<a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author_meta( 'display_name' , $post->post_author ) . '</a>';
                    echo '</div>';
                    echo get_the_post_thumbnail( $post->ID , self::$currSize );
                    echo '</div>';
                }
            }
        }
              
        function single( $postID )
        {
            global $myLayout;
            
            if( has_post_thumbnail( $postID ) ) {
				$src = wp_get_attachment_image_src( get_post_thumbnail_id( $postID ), 'full' );
				
                echo '<div class="post-thumbnail">';
				echo '<a href="' . $src[ 0 ] .'" rel="prettyPhoto">';
				echo '<div class="zoom"></div>';
                echo get_the_post_thumbnail( $postID , 'single_' .  $myLayout -> width );
				echo '</a>';
                echo '</div><div class="clearfix"></div>';
            }
        }
        
        function page( $postID )
        {
            $size = 'full'; /// todo : specify  thumbnail size myTheme::thumbnail( 'page-size' , $post -> ID )
            $show = true;
            if( false ){ /// todo : if show map
                echo '<div class="post-map">';
                /// todo : echo map
                echo '</div>';
                $show = false;
            }

            if( true && $show ){ /// todo : if show thumbnail
                if( has_post_thumbnail( $postID ) ){
                    echo '<div class="post-thumbnail">';
                    echo get_the_post_thumbnail( $postID , self::$currSize );
                    echo '</div><div class="clearfix"></div>';
                }
            }

            if( false ){ /// if show contact form
                echo '<div class="my-contact-form">';
                /// todo : echo form
                echo '</div>';
            }
        }
    }
?>