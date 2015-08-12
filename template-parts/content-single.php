<?php
/**
 * Template part for displaying single posts.
 *
 * @package nz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<div class="post-inner">
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title uk-text-center">', '</h2>' ); ?>
	<hr class="small-separetor"></hr>

		<div class="top-meta uk-text-center">
			<?php nz_top_meta(); ?>
		</div>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php do_action('nz_post_footer'); ?>

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
</article><!-- #post-## -->

