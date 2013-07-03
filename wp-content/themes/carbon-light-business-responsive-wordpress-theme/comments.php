<div id="comments">
    <div class="comments-area">
    	<?php if (post_password_required()) : ?>
    	<p><?php _e( 'Post is password protected. Enter the password to view any comments.', 'otw-carbon-light' ); ?></p>
    </div>

    	<?php return; endif; ?>

    <?php if (have_comments()) : ?>

    	<h3><span><?php _e( 'There are', 'otw-carbon-light' ); ?></span> <?php comments_number(__('no comments', 'otw-carbon-light'), __('one comment', 'otw-carbon-light'), __( '% comments', 'otw-carbon-light') ); ?></h3>

    	<ul>
            <?php wp_list_comments('type=comment&callback=otw_comments'); // Custom callback in functions.php ?>
    	</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'otw-carbon-light' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'otw-carbon-light' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
    	<p class="nocomments"><?php _e( 'Comments are closed here.', 'otw-carbon-light' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php comment_form(array('title_reply' => __( '<span>Leave</span> a reply', 'otw-carbon-light' ))); ?>
</div>