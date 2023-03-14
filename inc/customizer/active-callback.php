<?php
/**
 * Active Callback Functions
 *
 * @package TODO
*/

/**
 * Active Callback
 */
function todo_banner_ac( $control ){
    $edbanner    = $control->manager->get_setting( 'ed_banner_section' )->value();
    $control_id  = $control->id;
    
    // static banner controls
    if ( $control_id == 'header_image' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $edbanner == 'static_banner' ) return true;

    // banner title and description controls
    if ( $control_id == 'banner_subtitle' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $edbanner == 'static_banner' ) return true;

    // Link button controls
    if ( $control_id == 'banner_link_one_label' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_one_url' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two_label' && $edbanner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_two_url' && $edbanner == 'static_banner' ) return true;

    return false;
}

/**
 * Header Button
*/
function todo_header_button_ac( $control ){    
    $ed_header_btn = $control->manager->get_setting( 'ed_header_btn' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'header_button_label' && $ed_header_btn == true ) return true;
    if ( $control_id == 'header_button_url' && $ed_header_btn == true ) return true;
    
    return false;
}

/**
 * Active Callback for featuerd content
*/
function todo_featured_ac( $control ){    
    $ed_featured_section = $control->manager->get_setting( 'ed_featured_section' )->value();
    $control_id          = $control->id;
    
    if ( $control_id == 'home_featured_post' && $ed_featured_section == true ) return true;
    
    return false;
}

/**
 * Active callback for Related posts
 */
function todo_related_posts_ac( $control ){
    $ed_related_post = $control->manager->get_setting( 'ed_related_post' )->value();
    $control_id      = $control->id;
    
    if ( $control_id == 'related_post_title' && $ed_related_post == true ) return true;
    if ( $control_id == 'related_taxonomy' && $ed_related_post == true ) return true;
    
    return false;
}

/**
 * Active callback for Newsletter
 */
function todo_newsletter_ac( $control ){
    $ed_newsletter_section = $control->manager->get_setting( 'ed_newsletter_section' )->value();
    $control_id            = $control->id;
    
    if ( $control_id == 'newsletter_shortcode' && $ed_newsletter_section == true ) return true;
    
    return false;
}

/**
 * Active callback for Instagram
 */
function todo_instagram_ac( $control ){
    $ed_instagram_section = $control->manager->get_setting( 'ed_instagram_section' )->value();
    $control_id           = $control->id;
    
    if ( $control_id == 'instagram_title' && $ed_instagram_section == true ) return true;
    if ( $control_id == 'instagram_shortcode' && $ed_instagram_section == true ) return true;
    
    return false;
}