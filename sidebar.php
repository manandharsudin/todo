<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TODO
 */

$sidebar = todo_sidebar();

if ( ! $sidebar ){
	return;
}

?>

<aside id="secondary" class="widget-area" <?php todo_microdata( 'sidebar' ); ?>>
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
