<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TODO
 */

    /**
     * Content End
     * 
     * @hooked todo_content_end - 15
     */
    do_action( 'todo_content_end' );

    /**
     * @hooked todo_related_posts- 10
     * @hooked todo_comments- 20
    */
    do_action( 'todo_after_single_container' );    

    /**
     * Before Footer
     * 
     * @hooked todo_ad_before_footer     - 20
     * @hooked todo_newsletter           - 25
     * @hooked todo_instagram            - 30
     */
    do_action( 'todo_before_footer' );
    
    /**
     * @hooked todo_footer_start  - 15
     * @hooked todo_footer_top    - 20 
     * @hooked todo_footer_bottom - 25
     * @hooked todo_scrolltotop   - 30
     * @hooked todo_footer_end    - 35 
     */
    do_action( 'todo_footer' );
    
    /**
     * After Footer
     * 
     * @hooked todo_page_end - 15
    */
    do_action( 'todo_after_footer' );
    
    wp_footer(); ?>

</body>
</html>