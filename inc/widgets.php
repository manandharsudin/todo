<?php
/**
 * Widget Areas
 * 
 * @link https: //developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @package TODO
 */

if( ! function_exists( 'todo_widgets_init' ) ) :
function todo_widgets_init(){    
    $sidebars = array(
        'sidebar'   => array(
            'name'        => esc_html__( 'Sidebar', 'todo' ),
            'id'          => 'sidebar',
            'description' => esc_html__( 'Add widgets here.', 'todo' ),
        ),
        'after-header'   => array(
            'name'        => esc_html__( 'AD After Header', 'todo' ),
            'id'          => 'after-header',
            'description' => esc_html__( 'Add custom HTML for google AD.', 'todo' ),
        ),
        'before-footer'   => array(
            'name'        => esc_html__( 'AD Before Footer', 'todo' ),
            'id'          => 'before-footer',
            'description' => esc_html__( 'Add custom HTML for google AD.', 'todo' ),
        ),
        'footer-one'=> array(
            'name'        => __( 'Footer One', 'todo' ),
            'id'          => 'footer-one',
            'description' => __( 'Add footer one widgets here.', 'todo' ),
        ),
        'footer-two'=> array(
            'name'        => __( 'Footer Two', 'todo' ),
            'id'          => 'footer-two',
            'description' => __( 'Add footer two widgets here.', 'todo' ),
        ),
        'footer-three'=> array(
            'name'        => __( 'Footer Three', 'todo' ),
            'id'          => 'footer-three',
            'description' => __( 'Add footer three widgets here.', 'todo' ),
        ),
        'footer-four'=> array(
            'name'        => __( 'Footer Four', 'todo' ),
            'id'          => 'footer-four',
            'description' => __( 'Add footer four widgets here.', 'todo' ),
        ),
    );
    
    foreach( $sidebars as $sidebar ){
        register_sidebar( array(
    		'name'          => esc_html( $sidebar['name'] ),
    		'id'            => esc_attr( $sidebar['id'] ),
    		'description'   => esc_html( $sidebar['description'] ),
    		'before_widget' => '<section id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</section>',
    		'before_title'  => '<h2 class="widget-title" itemprop="name">',
    		'after_title'   => '</h2>',
    	) );
    }
}
endif;
add_action( 'widgets_init', 'todo_widgets_init' );