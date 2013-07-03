<?php
global $myLayout;

function my_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment -> comment_type ) {
        case '' : {
            echo '<li '; comment_class(); echo' id="li-comment-'; comment_ID(); echo '">';
            echo '<div id="comment-'; comment_ID(); echo '" class="comment-box">';
            echo '<header>';
            echo '<span class="arrow"></span>';
            echo myTheme::gravatar( $comment -> comment_author_email , 50 );
            echo '<span class="comment-meta">';
            echo '<time class="comment-time"><i class="icon-date"></i> ';
            printf( '%1$s ' , get_comment_date() );
            echo '</time>';
            echo '<span class="comment-replay">';
            comment_reply_link(  array_merge(  $args , array( 
                'depth' => $depth, 
                'max_depth' => $args['max_depth'] 
            )));
            echo '</span>';
            echo '</span>';
            echo '<cite>';
            echo get_comment_author_link( $comment -> comment_ID );
            echo '</cite>';
            echo '<div class="clear"></div>';
            echo '</header>';

            echo '<p class="comment-quote">';
            if ( $comment -> comment_approved == '0' ) {
                echo '<em class="comment-awaiting-moderation">';
                _e( 'Your comment is awaiting moderation.' , 'myThemes' );
                echo '</em>';
            }
            echo get_comment_text();            
            echo '</p>';

            echo '</div>';
            echo '</li>';
            break;
        }	
        case 'pingback'  :{
        }
        case 'trackback' : {
            break;
        }
    }
}

if( comments_open() ){

    if( is_user_logged_in() ){
        echo '<div id="comments" class="comments-list user-logged-in">';
    }
    else{
        echo '<div id="comments" class="comments-list">';
    }
    
    /* WORDPRESS COMMENTS PASSWORD REQUIRED */
    if ( post_password_required() ) {
        echo '<p class="nopassword">';
        _e( 'This post is password protected. Enter the password to view any comments.' , 'myThemes' );
        echo '</p>';
        echo '</div>';
        return;
    }

    /* IF EXISTS WORDPRESS COMMENTS */
	if ( have_comments() ) {
        echo '<h3 class="comments-list">';
        
        if( count( get_comments( array( 'type' => 'comment' , 'post_id' => $post -> ID ) ) ) == 1 ) {
            _e( 'Comment' , 'myThemes' );
        }else{
            _e( 'Comments' , 'myThemes' );
        } 
        echo ' ( <strong>' . count( get_comments( array( 'type' => 'comment' , 'post_id' => $post -> ID ) ) ). '</strong> )'; 
        echo '</h3>';
		
        echo '<ol>';
        wp_list_comments( array( 'callback' => 'my_comment' , 'type' =>  'comment' ) );
        echo '</ol>';
        
        /* WORDPRESS PAGINATION FOR COMMENTS */
        echo '<div class="pagination comments">';
        echo '<nav class="inline aligncenter">';
        echo paginate_comments_links();
        echo '</nav>';
        echo '</div>';
    }
	
    /* FORM SUBMIT COMMENTS */
    $commenter = wp_get_current_commenter();

    /* CHECK VALUES */
    if( esc_attr( $commenter[ 'comment_author' ] ) )
        $name = esc_attr( $commenter[ 'comment_author' ] );
    else
        $name = __( 'Nickname ( required )' , 'myThemes' );

    if( esc_attr( $commenter[ 'comment_author_email' ] ) )
        $email = esc_attr( $commenter[ 'comment_author_email' ] );
    else
        $email = __( 'E-mail ( required )' , 'myThemes' );

    if( esc_attr( $commenter[ 'comment_author_url' ] ) )
        $web = esc_attr( $commenter[ 'comment_author_url' ] );
    else
        $web = __( 'Website' , 'myThemes' );

    /* FIELDS */
    $fields =  array(
        'author' => '<div class="field">'.
                '<p class="comment-form-author input">'.
                '<input class="required" value="' . $name . '" onfocus="if (this.value == \'' . __( 'Nickname ( required )' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'Nickname ( required )' , 'myThemes' ) . '\';}" id="author" name="author" type="text" size="30"  />' .
            '</p>',
        'email'  => '<p class="comment-form-email input">'.
                '<input class="required" value="' . $email . '" onfocus="if (this.value == \'' . __( 'E-mail ( required )' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'E-mail ( required )' , 'myThemes' ) . '\';}" id="email" name="email" type="text" size="30" />' .
            '</p>',
        'url'    => '<p class="comment-form-url input">'.
                '<input value="' . $web . '" onfocus="if (this.value == \'' . __( 'Website' , 'myThemes' ). '\') {this.value = \'\';}" onblur="if (this.value == \'\' ) { this.value = \'' . __( 'Website' , 'myThemes' ). '\';}" id="url" name="url" type="text" size="30" />' .
            '</p></div>',
    );
    

    $rett  = '<div class="textarea"><p class="comment-form-comment textarea user-not-logged-in">';
    $rett .= '<textarea id="comment" name="comment" cols="45" rows="10" aria-required="true"></textarea>';
    $rett .= '</p></div>';

    $args = array(	
        'title_reply' => __( "Leave a reply" , 'myThemes' ),
        'comment_notes_after'   => '',
        'comment_notes_before'  => '<p class="comment-notes">' . __( 'Your email address will not be published.' , 'myThemes' ) . '</p>',
        'logged_in_as'          => '<p class="logged-in-as">' . __( 'Logged in as' , 'myThemes' ) . ' <a href="' . home_url('/wp-admin/profile.php') . '">' . get_the_author_meta( 'nickname' , get_current_user_id() ) . '</a>. <a href="' . wp_logout_url( get_permalink( $post -> ID ) ) .'" title="' . __( 'Log out of this account' , 'myThemes' ) . '">' . __( 'Log out?' , 'myThemes' ) . ' </a></p>',		
        'fields'                => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'         => $rett,
        'label_submit'          => __( 'Submit Comment' , 'myThemes' )
    );

    comment_form( $args );
    echo '<div class="clear"></div>';
    echo '</div>';
}
?>