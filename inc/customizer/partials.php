<?php
/**
 * Render the site title for the selective refresh partial.
 */

function todo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function todo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Header Button label
*/
function todo_header_button_label(){
    return esc_html( get_theme_mod( 'header_button_label', __( 'RSVP', 'todo' ) ) );
}

/**
 * Banner SubTitle
*/
function todo_banner_subtitle(){
    return esc_html( get_theme_mod( 'banner_subtitle', __( 'Free Blogging Course', 'todo' ) ) );
}

/**
 * Banner Title
*/
function todo_banner_title(){
    return esc_html( get_theme_mod( 'banner_title', __( 'Are you Ready to Start a Profitable Blog?', 'todo' ) ) );
}

/**
 * Banner One label
*/
function todo_banner_link_one_label(){
    return esc_html( get_theme_mod( 'banner_link_one_label', __( 'Get Started', 'todo' ) ) );
}

/**
 * Banner Two label
*/
function todo_banner_link_two_label(){
    return esc_html( get_theme_mod( 'banner_link_two_label', __( 'Learn More', 'todo' ) ) );
}

/**
 * Related Post Title
*/
function todo_get_related_title(){
    return esc_html( get_theme_mod( 'related_post_title', __( 'You Might Also Like', 'todo' ) ) );
}

/**
 * Home Text
*/
function todo_home_text(){
    return esc_html( get_theme_mod( 'home_text', __( "Home", 'todo' ) ) );
}

/**
 * Instagram Title
*/
function todo_instagram_title(){
    return esc_html( get_theme_mod( 'instagram_title', __( 'I\'m on instagram', 'todo' ) ) );
}

/**
 * Footer Copyright
*/
function todo_get_footer_copyright(){
    $copyright = get_theme_mod( 'footer_copyright' );
    echo '<span class="copy-right">';
    if( $copyright ){
        echo wp_kses_post( $copyright );
    }else{
        esc_html_e( '&copy; Copyright ', 'todo' );
        echo date_i18n( esc_html__( 'Y', 'todo' ) );
        echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>. ';
    }
    echo '</span>'; 
}