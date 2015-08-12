<?php
global $post,
$mk_options;

$single_layout = $mk_options['single_layout'];
if ($single_layout!='full') {
	if ($single_layout == 'left') {
		$layout_css = 'uk-width-medium-2-3 uk-width-large-3-4 uk-flex-order-last';
	} else {
		$layout_css = 'uk-width-medium-2-3 uk-width-large-3-4';
	}

} else {
	$layout_css = 'uk-width-1-1';
}


get_header(); ?>

	<div id="primary" class="content-area <?php echo $layout_css;?>">

		<main id="main" class="site-main post-list" role="main">
			<div class="post-content">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>
			<?php echo $single_layout;?>
			<?php //the_post_navigation(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>
				</div>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php  if($single_layout != 'full') get_sidebar();  ?>
<?php get_footer(); ?>
