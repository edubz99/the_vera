<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<div class="comments-header">
			<h2 class="comments-title"><?php esc_html_e('Post Comments', 'capstone'); ?></h2>
		</div>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 65,
				) );
			?>			
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'capstone' ); ?></p>
	<?php endif; ?>

	<?php

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
	

		$fields =  array(

		  'author' =>
		    '<div class="row align-justified"><div class="column" data-col="6"><p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'capstone' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' /></p></div>',

		  'email' =>
		    '<div class="column last-column" data-col="6"><p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'capstone' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
		    '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' /></p></div></div>',

		  'url' =>
		    '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'capstone' ) . '</label>' .
		    '<input id="url" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) .
		    '" size="30" /></p>',
		);


		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'fields' 			 => apply_filters( 'comment_form_default_fields', $fields ),
		) );
	?>

</div><!-- .comments-area -->