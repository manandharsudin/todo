<?php
/**
 * WordPress Actions and Filters
 *
 * @package TODO
 */

if ( ! function_exists( 'todo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function todo_setup() {
    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on TODO, use a find and replace
    * to change 'todo' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'todo', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary'   => esc_html__( 'Primary', 'todo' ),
            'secondary' => esc_html__( 'Secondary', 'todo' ),
        )
    );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'todo_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    //adding exceprt feature on the page
    add_post_type_support( 'page', 'excerpt' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for block editor styles.
    add_theme_support( 'wp-block-styles' );
    
    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' ) 
        )
    );

    add_theme_support( 
        'custom-header', 
        apply_filters( 'todo_custom_header_args',
            array(
                'default-image'    => get_template_directory_uri().'/assets/images/banner-img.jpg',
                'width'            => 1440,
                'height'           => 800,
                'video'            => true,
                'wp-head-callback' => 'todo_header_style',
            ) 
        ) 
    );

    register_default_headers( 
        array(
            'default-image' => array(
                'url'           => '%s/assets/images/banner-img.jpg',
                'thumbnail_url' => '%s/assets/images/banner-img.jpg',
                'description'   => __( 'Default Header Image', 'todo' ),
            ),
        ) 
    );


    //Image Sizes    
    // add_image_size( 'todo-full', 1260, 602, true ); @todo Add image size

    // Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
endif;
add_action( 'after_setup_theme', 'todo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function todo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'todo_content_width', 844 );
}
add_action( 'after_setup_theme', 'todo_content_width', 0 );

if( ! function_exists( 'todo_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function todo_template_redirect_content_width(){
    if( is_active_widget( 'sidebar' ) ){	   
        $GLOBALS['content_width'] = 844;
    }else{
        if( is_singular() ){
            if( todo_sidebar( true ) === 'fullwidth-centered' ){
                $GLOBALS['content_width'] = 700;
            }else{
                $GLOBALS['content_width'] = 1260;         
            }                
        }else{
            $GLOBALS['content_width'] = 1260;
        }
    }
}
endif;
add_action( 'template_redirect', 'todo_template_redirect_content_width' );

if( ! function_exists( 'todo_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function todo_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is false
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    wp_enqueue_style( 'todo-google-fonts', todo_google_fonts_url(), array(), null );
	wp_enqueue_style( 'todo-gutenberg', get_template_directory_uri(). '/assets/css/gutenberg' . $suffix . '.css', array(), TODO_VERSION );
	
	if( todo_is_woocommerce_activated() ){
		wp_enqueue_style( 'todo-woo', get_template_directory_uri(). '/assets/css/woocommerce' . $suffix . '.css', array(), TODO_VERSION );
	}

    wp_enqueue_style( 'todo-style', get_stylesheet_uri(), array(), TODO_VERSION );
	wp_style_add_data( 'todo-style', 'rtl', 'replace' );

    wp_enqueue_script( 'todo-accessibility', get_template_directory_uri() . '/assets/js/modal-accessibility' . $suffix . '.js', array(), TODO_VERSION, true );
	wp_enqueue_script( 'todo-custom', get_template_directory_uri() . '/assets/js/custom' . $suffix . '.js', array( 'jquery' ), TODO_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'todo_scripts' );

if( ! function_exists( 'todo_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function todo_block_editor_styles() {
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    // Block styles.
    wp_enqueue_style( 'todo-block-editor-style', get_template_directory_uri() . '/assets/css/editor-block' . $suffix . '.css' );

    // Add custom fonts.
    wp_enqueue_style( 'todo-google-fonts', todo_google_fonts_url(), array(), null );
}
endif;
add_action( 'enqueue_block_editor_assets', 'todo_block_editor_styles' );

if( ! function_exists( 'todo_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles.
*/
function todo_admin_scripts( $hook ){
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    if( $hook == 'themes.php' ){
        wp_enqueue_style( 'todo-admin', get_template_directory_uri() . '/assets/css/admin' . $suffix . '.css', '', TODO_VERSION );
    }
}
endif; 
add_action( 'admin_enqueue_scripts', 'todo_admin_scripts' );

if( ! function_exists( 'todo_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function todo_body_classes( $classes ) {	
	$editor_options      = get_option( 'classic-editor-replace' );
	$allow_users_options = get_option( 'classic-editor-allow-users' );
	$ed_banner_section   = get_theme_mod( 'ed_banner_section', 'no_banner' );
 
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $classes[] = 'header-layout-one';

    if( $ed_banner_section == 'static_banner' ){
        $classes[] = 'hs-static-banner static-banner-layout-one';        
    }

    if( is_single() ){
        $classes[] = 'single-layout1';
    }
    
	if ( ! is_singular() && !( todo_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ) && !is_404() ) {	
		$classes[] = 'post-list-style2';
	}

	if ( !todo_is_classic_editor_activated() || ( todo_is_classic_editor_activated() && $editor_options == 'block' ) || ( todo_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks() ) ) {
        $classes[] = 'todo-has-blocks';
    }

	$classes[] = todo_sidebar( true );

	return $classes;
}
endif;
add_filter( 'body_class', 'todo_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function todo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'todo_pingback_header' );

if( ! function_exists( 'todo_get_the_archive_title' ) ) :
/**
 * Filter Archive Title
*/
function todo_get_the_archive_title( $title ){
    $query_obj = get_queried_object();
    if( is_author() ){
        /* translators: Author archive title. 1: Author name */
        $title = sprintf( __( '%1$sPosts By Author%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . esc_html( $query_obj->display_name ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'todo' ), count_user_posts( $query_obj->ID ) ) . '</span>';
    }elseif( is_category() ){
        /* translators: Category archive title. 1: Category name */
        $title = sprintf( __( '%1$sCategory%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . single_cat_title( '', false ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'todo' ), $query_obj->count ) . '</span>';
    }elseif( is_tag() ){
        /* translators: Tag archive title. 1: Tag name */
        $title = sprintf( __( '%1$sTag%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . single_tag_title( '', false ) . '</h1>' );
        $title .= '<span class="post-count">' . sprintf( __( '%d POSTS', 'todo' ), $query_obj->count ) . '</span>';
    }elseif( is_year() ){
        /* translators: Yearly archive title. 1: Year */
        $title = sprintf( __( '%1$sYear%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'Y', 'yearly archives date format', 'todo' ) ) . '</h1>' );
    }elseif( is_month() ){
        /* translators: Monthly archive title. 1: Month name and year */
        $title = sprintf( __( '%1$sMonth%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'F Y', 'monthly archives date format', 'todo' ) ) . '</h1>' );
    }elseif( is_day() ){
        /* translators: Daily archive title. 1: Date */
        $title = sprintf( __( '%1$sDay%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . get_the_date( _x( 'F j, Y', 'daily archives date format', 'todo' ) ) . '</h1>' );
    }elseif( is_post_type_archive() ) {
        if( is_post_type_archive( 'product' ) ){
            $title = '<h1 class="page-title">' . get_the_title( get_option( 'woocommerce_shop_page_id' ) ) . '</h1>';
        }else{
            /* translators: Post type archive title. 1: Post type name */
            $title = sprintf( __( '%1$sArchives%2$s %3$s', 'todo' ), '<span class="sub-title">', '</span>', '<h1 class="page-title">' . post_type_archive_title( '', false ) . '</h1>' );
        }
    }elseif( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = '<span class="sub-title">' . esc_html( $tax->labels->singular_name ) . '</span><h1 class="page-title">' . single_term_title( '', false ) . '</h1>';
    }else {
        $title = sprintf( __( '%1$sArchives%2$s', 'todo' ), '<h1 class="page-title">', '</h1>' );
    }
    return $title;
}
endif;
add_filter( 'get_the_archive_title', 'todo_get_the_archive_title' );

if( ! function_exists( 'todo_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
 * @todo remove this if not needed
*/
function todo_exclude_cat( $query ){
    $home_featured_post = get_theme_mod( 'home_featured_post' );
    $excludes           = array();
    
    if( ! is_admin() && $query->is_main_query() && $query->is_home() ){        

        if( $home_featured_post ){
            $home_featured_post = array_map( 'intval', $home_featured_post );
            $excludes = array_diff( array_unique( array_merge( $excludes, $home_featured_post ) ), array('') );
        }

        $query->set( 'post__not_in', $excludes );
    }      
}
endif;
//add_filter( 'pre_get_posts', 'todo_exclude_cat' );