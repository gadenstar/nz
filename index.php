<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nz
 */

get_header(); ?>

	<div id="primary" class="content-area uk-width-small-1-1 uk-width-medium-2-3  uk-width-large-3-4">
			<main id="main" class="site-main post-list" role="main">
				<div id="icontent" class="uk-grid uk-grid-medium " data-uk-grid-margin>

					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );
							?>

						<?php endwhile; ?>



					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>
					<div id="navigation" class="page-nav uk-width-1-1">
						<div class="navigation-inner">
							<?php
								$navigation = ($mk_options['infinite-scroll'] == 'true') ? next_posts_link(__('MORE')) : nz_posts_navigation(5);
							?>
						</div>
					</div>
				</div>

			</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
