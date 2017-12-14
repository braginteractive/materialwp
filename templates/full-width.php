<?php
/**
 * Template Name: Full Width
 *
 * Displays a full width page without a sidebar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MaterialWP
 */

get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="content-area-full">
				<main id="main" class="site-main" role="main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- row -->
	</div><!-- container -->

<?php
get_footer();
