<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package materialwp
 */

get_header(); ?>

<div class="container">
	<div class="row">

	<div id="primary" class="col-md-12 col-lg-12">
		<main id="main" class="site-main" role="main">

			<div class="card">
				<div class="entry-container">
					<section class="error-404 not-found">
						<header>
							<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'materialwp' ); ?></h1>
						</header><!-- .page-header -->

					
						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'materialwp' ); ?></p>

							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php if ( materialwp_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
							<div class="widget widget_categories">
								<h2 class="widget-title"><?php _e( 'Most Used Categories', 'materialwp' ); ?></h2>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									) );
								?>
								</ul>
							</div><!-- .widget -->
							<?php endif; ?>

							<?php
								/* translators: %1$s: smiley */
								$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'materialwp' ), convert_smilies( ':)' ) ) . '</p>';
								the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->
				</div><!-- .entry-content -->
			</div><!-- .card -->

		</main><!-- #main -->
	</div><!-- #primary -->

	</div> <!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>
