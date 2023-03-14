<?php
/**
 * Actions Hooks
 *
 * @package TODO
 */

if( ! function_exists( 'todo_doctype' ) ) :
/**
 * Doctype Declaration
*/
function todo_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'todo_doctype', 'todo_doctype' );

if( ! function_exists( 'todo_head' ) ) :
/**
 * Before wp_head 
*/
function todo_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'todo_before_wp_head', 'todo_head' );

if( ! function_exists( 'todo_page_start' ) ) :
/**
 * Page Start
*/
function todo_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'todo' ); ?></a>
    <?php
}
endif;
add_action( 'todo_before_header', 'todo_page_start', 20 );

if( ! function_exists( 'todo_header' ) ) :
/**
 * Header Start
*/
function todo_header(){ 
    get_template_part( 'headers/one' );    
}
endif;
add_action( 'todo_header', 'todo_header', 20 );

if ( ! function_exists( 'todo_list' ) ) :
/**
 * Displays HomePage Banner
 */
function todo_list(){
    $defaults = array(
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
    );
	$todo_repeater = get_theme_mod( 'todo_repeater', $defaults );
	
	
	if( is_front_page() ){
		if( $todo_repeater ){ ?>
            <ul class="todo_list">
               <?php 
                    foreach( $todo_repeater as $todo ){
                        echo '<li>' . esc_html( $todo['todo'] ) . '</li>';
                    }
               ?>
            </ul><!-- .site-banner -->
		    <?php 
		}
	}
}
add_action( 'todo_after_header', 'todo_list', 15 );
endif;


if( ! function_exists( 'todo_content_start' ) ) :
/**
 * Content Start
 */
function todo_content_start(){ ?>
    <div id="content" class="site-content">
		<?php 
            todo_breadcrumb();            
            todo_content_header(); 
        ?>
		<div class="container">
			<div id="primary" class="content-area">
    <?php
}
endif;
add_action( 'todo_content_start', 'todo_content_start', 15 );

if( ! function_exists( 'todo_pagination' ) ) :
/**
 * Pagination
*/
function todo_pagination(){
    if( is_single() ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();
        if( $prev_post || $next_post ){?>            
            <nav class="navigation pagination" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'todo' ); ?></h2>
                <div class="nav-links">
                    <?php 
                        if( $prev_post ){ ?>
                            <div class="nav-previous">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                                    <span class="nav-text"><?php esc_html_e( 'Previous Article','todo' ); ?></span>
                                    <div class="nav-title-wrap">
                                        <figure>
                                            <?php
                                                $prev_img = get_post_thumbnail_id( $prev_post->ID );
                                                if( $prev_img ){
                                                    $prev_url = wp_get_attachment_image_url( $prev_img, 'full' );
                                                    echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';                                        
                                                }else{
                                                    todo_get_fallback_svg( 'full' );
                                                }
                                            ?>
                                        </figure>
                                        <h3 class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h3>
                                    </div>
                                </a>
                            </div>
                            <?php 
                        } 
                        
                        if( $next_post ){ ?>
                            <div class="nav-next">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                                <span class="nav-text"><?php esc_html_e( 'Next Article','todo' ); ?></span>
                                <div class="nav-title-wrap">
                                    <figure>
                                        <?php
                                        $next_img = get_post_thumbnail_id( $next_post->ID );
                                        if( $next_img ){
                                            $next_url = wp_get_attachment_image_url( $next_img, 'full' );
                                            echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';                                        
                                        }else{
                                            todo_get_fallback_svg( 'full' );
                                        }
                                        ?>
                                    </figure>
                                    <h3 class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h3>
                                </div>
                                </a>
                            </div>
                            <?php 
                        } 
                    ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => todo_svg_collection( 'pagination-prev' ),
            'next_text'          => todo_svg_collection( 'pagination-next' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'todo' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'todo_after_content_single', 'todo_pagination', 15 );
add_action( 'todo_after_posts', 'todo_pagination', 15 );

if( ! function_exists( 'todo_author_block' ) ) :
/**
 * Author Block
*/
function todo_author_block(){
    if( get_the_author_meta( 'description' ) ){ ?>
        <div class="author-block">
            <div class="author-header">
                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 95 ); ?></figure>
                <div class="title-wrap">
                    <span class="sub-title"><?php esc_html_e( 'WRITTEN BY', 'todo' ); ?></span>
                    <h3 class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h3>
                </div>
            </div>
            <div class="author-content-wrap">
                <div class="author-info">
                    <?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>
                </div>
            </div>
        </div><!-- .author-block -->
        <?php 
    }
}
endif;
add_action( 'todo_after_content_single', 'todo_author_block', 20 );

if( ! function_exists( 'todo_content_end' ) ) :
/**
 * Content End
 */
function todo_content_end(){ ?>
            </div><!-- #primary -->
	        <?php get_sidebar(); ?>
	    </div><!-- .container -->
    </div><!-- #content -->
    <?php
}
endif;
add_action( 'todo_content_end', 'todo_content_end', 15 );

if( ! function_exists( 'todo_related_posts' ) ) :
/**
 * Related Posts
*/
function todo_related_posts(){    
    if( is_singular( 'post' ) ){
        global $post;
        $args = array(
            'post_type'           => 'post',
            'posts_status'        => 'publish',
            'ignore_sticky_posts' => true,
            'post__not_in'        => array( $post->ID ),
            'orderby'             => 'rand',
            'posts_per_page'      => 3,
        );
        
        $ed_related_post     = get_theme_mod( 'ed_related_post', true );
        $related_post_title  = get_theme_mod( 'related_post_title',__(  'You Might Also Like', 'todo' ) );
        $related_tax         = get_theme_mod( 'related_taxonomy', 'cat' );
        
        if( $related_tax == 'cat' ){
            $cats = get_the_category( $post->ID );        
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
        }elseif( $related_tax == 'tag' ){
            $tags = get_the_tags( $post->ID );
            if( $tags ){
                $t = array();
                foreach( $tags as $tag ){
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;  
            }
        }
        $qry = new WP_Query( $args );
        
        if( $ed_related_post && $qry->have_posts() ){ ?>   
            <div class="related-posts normal-corner">
                <div class="container">
                    <?php if( $related_post_title ){ ?>
                        <h2 class="related-title">
                            <?php echo esc_html( $related_post_title ); ?>
                        </h2>
                    <?php } ?>
                    <div class="related-post-wrap">
                        <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                            <article class="post">
                                <figure class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            if( has_post_thumbnail() ){
                                                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
                                            }else{ 
                                                todo_get_fallback_svg( 'todo-full' );
                                            }
                                        ?>
                                    </a>
                                </figure>
                                <header class="entry-header">
                                    <?php todo_category(); ?>
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-meta">
                                        <?php todo_posted_on(); ?>
                                    </div>
                                </header><!-- .entry-header -->
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- .related-posts -->
            <?php
            wp_reset_postdata();
        }
    }
}
endif;
add_action( 'todo_after_single_container','todo_related_posts',10 );

if( ! function_exists( 'todo_comments' ) ) :
/**
 * Pagination
*/
function todo_comments(){
    if( todo_is_woocommerce_activated() && is_product() ) return;
    
    // If comments are open or we have at least one comment, load up the comment template.
    if ( is_singular() && ( comments_open() || get_comments_number() ) ) :
        comments_template();
    endif;
}
endif;
add_action( 'todo_after_single_container','todo_comments',20 );

if( ! function_exists( 'todo_ad_before_footer' ) ) :
/**
 * Widget Area Before Footer
 */
function todo_ad_before_footer(){
    if( is_active_sidebar( 'before-footer' ) && is_home() ){
        echo '<div class="before-footer-ad-widget">';
        dynamic_sidebar( 'before-footer' );
        echo '</div>';
    }
}
endif;
add_action( 'todo_before_footer', 'todo_ad_before_footer', 20 );

if( ! function_exists( 'todo_newsletter' ) ) :
/**
 * Newsletter
*/
function todo_newsletter(){
    $ed_newsletter_section = get_theme_mod( 'ed_newsletter_section', false );
    $newsletter_shortcode  = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter_section && $newsletter_shortcode ){ ?>
        <div class="newsletter-section">
            <?php if( $newsletter_shortcode ) echo do_shortcode( wp_kses_post( $newsletter_shortcode ) ); ?>
        </div>
        <?php 
    }
}
endif;
add_action( 'todo_before_footer', 'todo_newsletter', 25 );

if( ! function_exists( 'todo_instagram' ) ) :
/**
 * Instagram
*/
function todo_instagram(){
    $ed_instagram_section       = get_theme_mod( 'ed_instagram_section', false );
    $instagram_title            = get_theme_mod( 'instagram_title',__( 'I\'m on instagram', 'todo' ) );
    $instagram_shortcode        = get_theme_mod( 'instagram_shortcode' );
    if( $ed_instagram_section && $instagram_title && $instagram_shortcode ){ ?>
        <div class="instagram-section">
            <?php if( $instagram_title ) echo '<h2 class="section-title">' . esc_html( $instagram_title ). '</h2>'; ?>
            <?php if( $instagram_shortcode ) echo do_shortcode( wp_kses_post( $instagram_shortcode ) ); ?>
        </div>
        <?php 
    }
}
endif;
add_action( 'todo_before_footer', 'todo_instagram', 30 );

if( ! function_exists( 'todo_footer_start' ) ) :
/**
 * Footer Start
 */
function todo_footer_start(){ ?>
    <footer id="colophon" class="site-footer" <?php todo_microdata( 'footer' ); ?>>
    <?php
}
endif;
add_action( 'todo_footer', 'todo_footer_start', 15 );

if( ! function_exists( 'todo_footer_top' ) ) :
/**
 * Footer Top
*/
function todo_footer_top(){
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;

    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }

    if( $active_sidebars ){ ?>
        <div class="top-footer">
    		<div class="container">
    			<div class="footer-grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'todo_footer', 'todo_footer_top', 20 );

if( ! function_exists( 'todo_footer_bottom' ) ) :
/**
 * Footer Bottom
 */
function todo_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="container">
            <div class="copyright">
                <?php
                    todo_get_footer_copyright();
                    todo_author_link();
                    todo_wp_link();
                    the_privacy_policy_link();
                ?>    
            </div>
            <?php todo_get_footer_social(); ?>
        </div>
    </div><!-- .bottom-footer -->
    <?php
}
endif;
add_action( 'todo_footer', 'todo_footer_bottom', 25 );

if( ! function_exists( 'todo_scrolltotop' ) ) :
/**
 * Scroll Up to Top
*/
function todo_scrolltotop(){ ?>
    <button class="goto-top">
        <?php echo todo_svg_collection( 'gototop' ); ?>
    </button>
    <?php
}
endif;
add_action( 'todo_footer', 'todo_scrolltotop', 30 );

if( ! function_exists( 'todo_footer_end' ) ) :
/**
 * Footer End
 */
function todo_footer_end(){ ?>
    </footer><!-- .site-footer -->
    <?php
}
endif;
add_action( 'todo_footer', 'todo_footer_end', 35 );

if( ! function_exists( 'todo_page_end' ) ) :
/**
 * Page End
*/
function todo_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'todo_after_footer', 'todo_page_end', 15 );