<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package nz
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
global $mk_options;

$post_id = global_get_post_id();
?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
lsdfhlk
<?php if ( $mk_options['custom_favicon'] ) : ?>
  <link rel="shortcut icon" href="<?php echo $mk_options['custom_favicon']; ?>"  />
<?php else : ?>
	<link rel="shortcut icon" href="<?php echo THEME_IMAGES; ?>/favicon.png"  />
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php do_action('header_warp'); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="uk-container uk-container-center">
		<div class="uk-flex">
				<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					<nav class="uk-navbar">
					    <ul class="uk-navbar-nav uk-hidden-small">...</ul>
					    <a href="#my-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
					</nav>

					<div id="my-id" class="uk-offcanvas">
					    ...
					</div>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
