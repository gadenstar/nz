<!DOCTYPE html>
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

<?php if ( $mk_options['custom_favicon'] ) : ?>
  <link rel="shortcut icon" href="<?php echo $mk_options['custom_favicon']; ?>"  />
<?php else : ?>
	<link rel="shortcut icon" href="<?php echo THEME_IMAGES; ?>/favicon.png"  />
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>


</head>
<?php

$header_style = !empty($mk_options['theme_header_style']) ? $mk_options['theme_header_style'] : 1;

$header_grid_start = ($mk_options['header_grid'] == 'true') ? '<div class="mk-grid header-grid">' : '';
$header_grid_end = ($mk_options['header_grid'] == 'true') ? '</div>' : '';
$header_width_class = ($mk_options['header_grid'] == 'true') ? 'boxed-header' : 'full-header';

 ?>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<?php do_action('header_warp'); ?>

	<?php do_action('header_banner'); ?>
<!-- 	<header id="masthead" class="site-header" role="banner">
		<div class="uk-container uk-container-center">
		<div class="uk-flex">
				<div class="site-branding">
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>
				</div>

				<nav id="site-navigation" class="main-navigation nav_style_1 " role="navigation">
					<?php // wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					<nav class="uk-navbar">
					    <ul class="uk-navbar-nav uk-hidden-small">...</ul>
					    <a href="#my-id" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas></a>
					</nav>

					<div id="my-id" class="uk-offcanvas">
					    ...
					</div>
				</nav>
			</div>
		</div>
	</header> -->
	<div id="content" class="site-content has-sidebar">
	<div class="uk-container-center uk-container">
		<div class="uk-grid uk-grid-medium">
