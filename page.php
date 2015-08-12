<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package nz
 */

get_header(); ?>
<div id="primary" class="content-area uk-width-small-1-1 uk-width-medium-2-3  uk-width-large-3-4">

		<main id="main" class="site-main post-list" role="main">
			<div class="post-content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

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

<?php get_sidebar(); ?>
<?php get_footer(); ?>
