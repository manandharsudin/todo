<?php
/**
 * ToDo Settings
 *
 * @package TODO
*/

if( ! function_exists( 'todo_customize_register_todo' ) ) :
function todo_customize_register_todo( $wp_customize ){
    
    /** ToDo Settings */
    $wp_customize->add_section(
        'todo_settings',
        array(
            'title'    => __( 'ToDo Settings', 'todo' ),
            'priority' => 25,
        )
    );

    /** ToDo Links */
    $wp_customize->add_setting( 
        new TODO_Repeater_Setting( 
            $wp_customize, 
            'todo_repeater', 
            array(                
                'default' => array(
                    array(
                        'todo' => 'Todo List One'
                    ),
                    array(
                        'todo' => 'Todo List Two'
                    ),
                    array(
                        'todo' => 'Todo List Three'
                    ),
                    array(
                        'todo' => 'Todo List Four'
                    ),
                    array(
                        'todo' => 'Todo List Five'
                    ),
                ),
                'sanitize_callback' => array( 'TODO_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new TODO_Control_Repeater(
			$wp_customize,
			'todo_repeater',            
			array(
				'section' => 'todo_settings',
				'label'   => esc_html__( 'To Do', 'todo' ),
				'fields'  => array(
                    'todo' => array(
                        'type'        => 'text',
                        'label'       => esc_html__( 'To Do', 'todo' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => esc_html__( 'todo', 'todo' ),
                    'field' => 'todo'
                )
			)
		)
	);
}
endif;
add_action( 'customize_register', 'todo_customize_register_todo' );