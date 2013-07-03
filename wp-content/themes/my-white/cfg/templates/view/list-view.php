<?php global $post; ?>
<article <?php post_class(); ?>>
    <?php $classes = 'no-margin-right'; ?>
    <?php if( has_post_thumbnail() ) { ?>
        <div class="thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'thumbnail' ); $classes = ''; ?>
            </a>
        </div>
    <?php } ?>
    
    <?php if( !empty( $post -> post_title ) ) { ?>
    
        <h2><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( $post -> post_title ); ?>"><?php the_title(); ?></a></h2>
    
    <?php } else { ?>
        
        <h2><a href="<?php the_permalink() ?>"><?php _e( 'Read more about ..' , 'myThemes' ) ?></a></h2>
        
    <?php } ?>

    <div class="meta">
        <?php
            $firstName  = get_the_author_meta( 'first_name' , $post-> post_author );
            $lastName   = get_the_author_meta( 'last_name' , $post-> post_author );
            $printName  = get_the_author_meta( 'display_name' , $post-> post_author );

            if( strlen( $firstName . $lastName ) )
                $name = $firstName . ' ' . $lastName;
            else
                $name = $printName
        ?>
        <div class="author <?php echo $classes; ?>">
            <a href="<?php echo get_author_posts_url( $post-> post_author ); ?>" title="<?php _e( 'Posted by ' , 'myThemes' ); echo esc_attr( $name ); ?>"><i class="icon-author"></i> <?php echo $name ?></a>
        </div>
        <div class="meta-data">
            <time <?php echo 'datetime="' . get_post_time( 'Y-m-d', false , $post -> ID  ) . '"'; ?>><i class="icon-date"></i> <?php the_time( get_option( 'date_format' ) ); ?></time>
            <?php if ( comments_open() ){ ?>
                <span class="comments">
                    <?php
                        $nr = get_comments_number( $post -> ID );
                        if( $nr == 1){
                            $comments = $nr . ' ' . __( 'Comment' , 'myThemes' );
                        }
                        else{
                            $comments = $nr . ' ' . __( 'Comments' , 'myThemes' );
                        }
                    ?>
                    <a href="<?php echo get_comments_link( $post -> ID ); ?>"><i class="icon-comments"></i><?php echo $comments ?></a>
                </span>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>

    <p><?php the_excerpt(); ?></p>
</article>