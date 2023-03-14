<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TODO
 */

get_header(); ?>
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );
            
		endwhile; // End of the loop.

        /**
         * @hooked todo_pagination   - 15 
         * @hooked todo_author_block - 20
        */
        do_action( 'todo_after_content_single' );
		?>
	</main><!-- #main -->
<?php
get_footer();