<?php
/**
 * Customizer Control
 * 
 * @package TODO
*/

if( ! function_exists( 'todo_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function todo_register_custom_controls( $wp_customize ){    
    // Load our custom control.
    require_once get_template_directory() . '/inc/customizer-controls/note/class-note-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/radioimg/class-radio-image-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/customizer-controls/repeater/class-control-repeater.php';
    require_once get_template_directory() . '/inc/customizer-controls/select/class-select-control.php';
    require_once get_template_directory() . '/inc/customizer-controls/toggle/class-toggle-control.php';
            
    // Register the control type.
    $wp_customize->register_control_type( 'TODO_Radio_Image_Control' );
    $wp_customize->register_control_type( 'TODO_Select_Control' );
    $wp_customize->register_control_type( 'TODO_Toggle_Control' );
}
endif;
add_action( 'customize_register', 'todo_register_custom_controls' );