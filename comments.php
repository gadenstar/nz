<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package nz
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title h3-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '1 Comments ', '%1$s Comments ', get_comments_number(), 'comments title', 'nz' ) ),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'nz' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'nz' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'nz' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'type'       => 'comment',
					'callback'   => 'mytheme_comment',
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'nz' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'nz' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'nz' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'nz' ); ?></p>
	<?php endif; ?>

<?php

		$fields =  array(
			'author'=> '<div class="comment-form-name comment-form-row"><input type="text" name="author" class="text_input" id="author" tabindex="54" placeholder="'.__('Name (Required)', 'mk_framework').'"  /><i class="uk-icon-user"></i></div>',
			'email' => '<div class="comment-form-email comment-form-row"><input type="text" name="email" class="text_input" id="email" tabindex="56" placeholder="'.__('Email (Required)', 'mk_framework').'" /><i class="uk-icon-envelope-o"></i></div>',
			'url' 	=> '<div class="comment-form-website comment-form-row"><input type="text" name="url" class="text_input" id="url" tabindex="57" placeholder="'.__('Website', 'mk_framework').'" /><i class="uk-icon-globe"></i></div>',
		);

		//Comment Form Args
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>'<div class="respond-heading">'.__('Leave a Comment', 'mk_framework').'</div>',
			'comment_field' => '<div class="comment-textarea"><textarea placeholder="'.__('LEAVE YOUR COMMENT', 'mk_framework').'" class="textarea" name="comment" rows="8" id="comment" tabindex="58"></textarea></div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'label_submit' => __('POST COMMENT','mk_framework')
		);
		comment_form($comments_args);
	?>

</div><!-- #comments -->
