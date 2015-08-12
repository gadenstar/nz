<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package nz
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area uk-width-medium-1-3 uk-width-large-1-4" role="complementary">
  <div class="sidebar-warp">
	 <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
</div><!-- #secondary -->
