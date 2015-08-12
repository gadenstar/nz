<?php
/**
 * Template part for displaying posts.
 *
 * @package nz
 */
if ( has_post_thumbnail() ) {
	$post_class = 'has_img';
}else {
	$post_class = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('uk-width-medium-1-1 uk-width-large-1-2'); ?>>
			<?php
if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  //the_post_thumbnail();
  $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');

}
?>
	<div class="post-bg uk-cover-background" style="background-image:url(<?php echo $full_image_url[0]; ?>);">


	<div class="post-inner ">
		<header class="post-header">
			<div class="post-cats">
				<?php echo get_the_category_list( esc_html__( ', ', 'nz' ) ); ?>
			</div>
			<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="top-meta">
				<?php nz_top_meta(); ?>
			</div>


			<div class="post-desc">
				<?php
						$content = get_the_content();
						$trimmed_content = wp_trim_words( $content, 80, '...' );
						echo $trimmed_content;
				?>
			</div>
			<div class="bottom-meta">
				<a href="<?php the_permalink(); ?>" class="read-more">Read More <i class="uk-icon-long-arrow-right"></i>
	      </a>
			</div>


			<?php if ( 'post' == get_post_type() ) : ?>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nz' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">

		</footer><!-- .entry-footer -->
	</div>
	</div>
</article><!-- #post-## -->
