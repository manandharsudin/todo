<?php
/**
 * Header One
 * 
 * @package TODO
 */

$ed_social        = get_theme_mod( 'ed_social_links', false );
$ed_header_search = get_theme_mod( 'ed_header_search', false );
$ed_header_btn    = get_theme_mod( 'ed_header_btn', false ); ?>

<header id="masthead" class="site-header layout-one hide-element" <?php todo_microdata( 'header' ); ?>>
    <?php if( $ed_social || $ed_header_search || $ed_header_btn ){ ?>
        <div class="top-header">
            <div class="container">
                <?php 
                    todo_header_social(); 
                    if( $ed_header_search || $ed_header_btn ){ ?>			
                        <div class="header-right">				
                            <?php 
                                todo_header_search();                                
                                todo_header_button(); 
                            ?>
                        </div>					
                        <?php 
                    } 
                ?>
            </div>
        </div><!-- .top-header -->
    <?php } ?>
	<div class="mid-header">
		<div class="container">
			<?php 
                todo_main_navigation(); 
                todo_site_branding();
                todo_secondary_navigation();
            ?>
		</div>
	</div><!-- .mid-header-->
</header><!-- #masthead -->

<?php todo_mobile_header();