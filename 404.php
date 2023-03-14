<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TODO
 */

get_header(); ?>

	<main class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Uh-Oh...', 'todo' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'todo' ); ?></p>

				<div class="error-num"><?php esc_html_e( '404', 'todo' ); ?></div>

				<?php get_search_form(); ?>

				<div class="btn-wrap">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Back to Homepage', 'todo' ); ?></a>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();