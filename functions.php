<?php
/**
 * TODO functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TODO
 */

$todo_theme = wp_get_theme();
if( ! defined( 'TODO_VERSION' ) ) define( 'TODO_VERSION', $todo_theme->get( 'Version' ) );
if( ! defined( 'TODO_NAME' ) ) define( 'TODO_NAME', $todo_theme->get( 'Name' ) );
if( ! defined( 'TODO_TEXTDOMAIN' ) ) define( 'TODO_TEXTDOMAIN', $todo_theme->get( 'TextDomain' ) );
/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom Controls
 */
require get_template_directory() . '/inc/customizer-controls/customizer-control.php';

/**
 * WordPress Actions and Filters
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Helper Functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Actions Hooks
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Filter Hooks
 */
require get_template_directory() . '/inc/filters.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';