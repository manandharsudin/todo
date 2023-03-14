<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TODO
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); todo_microdata( 'article' ); ?>>
	<?php todo_post_thumbnail(); ?>
	<header class="entry-header">
		<?php 
			todo_category();
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );		
        
		    if ( 'post' === get_post_type() ){ ?>
                <div class="entry-meta">
                    <?php todo_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php 
            } 
        ?>
	</header><!-- .entry-header -->
</article><!-- ##post -->