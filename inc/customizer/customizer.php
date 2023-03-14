<?php
/**
 * Sublime Blog Theme Customizer
 *
 * @package TODO
*/

require get_template_directory() . '/inc/customizer/todo.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function todo_customize_preview_js() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'todo-customizer', get_template_directory_uri() . '/assets/js/customizer' . $suffix . '.js', array( 'customize-preview' ), TODO_VERSION, true );
}
add_action( 'customize_preview_init', 'todo_customize_preview_js' );

/**
 * Add misc inline scripts to our controls.
 *
 * We don't want to add these to the controls themselves, as they will be repeated
 * each time the control is initialized.
 */
function todo_control_inline_scripts() {
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_style( 'todo-customize', get_template_directory_uri() . '/assets/css/customize' . $suffix . '.css', array(), TODO_VERSION );
	wp_enqueue_script( 'todo-customize', get_template_directory_uri() . '/assets/js/customize' . $suffix . '.js', array( 'jquery', 'customize-controls' ), TODO_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'todo_control_inline_scripts', 100 );

/**
 * Sanitization Functions 
*/
require get_template_directory() . '/inc/customizer/sanitization-callback.php';

/**
 * Active Callback Functions 
*/
require get_template_directory() . '/inc/customizer/active-callback.php';

/**
 * Partial Refresh
*/
require get_template_directory() .'/inc/customizer/partials.php';