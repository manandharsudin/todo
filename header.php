<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TODO
 */
    /**
     * Doctype Hook
     * 
     * @hooked todo_doctype
    */
    do_action( 'todo_doctype' );
?>
<head <?php todo_microdata( 'head' ); ?>>
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked todo_head
    */
    do_action( 'todo_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); todo_microdata( 'body' ); ?>>
<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked todo_page_start - 20 
    */
    do_action( 'todo_before_header' );

	/**
     * Header
     * 
     * @hooked todo_header - 20     
    */
    do_action( 'todo_header' );
    
	/**
     * After header
     * 
     * @hooked todo_list - 15
     */
    do_action( 'todo_after_header' );

    /**
     * Content Start
     * 
     * @hooked todo_content_start - 15
     */
    do_action( 'todo_content_start' );