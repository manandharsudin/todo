<?php
/**
 * Filter Hooks
 *
 * @package TODO
 */

if( ! function_exists( 'todo_newsletter_bg_color' ) ) :
function todo_newsletter_bg_color(){
    return '#F0E9EE';
}
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'todo_newsletter_bg_color' );