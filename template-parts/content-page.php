<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package nz
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
	<div class="post-inner ">
	<header class="entry-header uk-text-center">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->
	<hr class="small-separetor"></hr>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nz' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'nz' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->

