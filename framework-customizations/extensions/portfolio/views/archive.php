<?php
get_header();
global $wp_query;
$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

$taxonomy        = $ext_portfolio_settings['taxonomy_name'];
$term            = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
$term_id         = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;
$categories      = fw_ext_portfolio_get_listing_categories( $term_id );

$listing_classes = fw_ext_portfolio_get_sort_classes( $wp_query->posts, $categories );
$loop_data       = array(
	'settings'        => $ext_portfolio_instance->get_settings(),
	'categories'      => $categories,
	'image_sizes'     => $ext_portfolio_instance->get_image_sizes(),
	'listing_classes' => $listing_classes
);
set_query_var( 'fw_portfolio_loop_data', $loop_data );
?>
<div class="container">
	<div class="row">
		<section id="primary" class="site-content portfolio-content col-lg-12">
			<div id="content" role="main">
				<header class="entry-header">
					<?php //fw_print($backup); fw_print($categories);fw_print($listing_classes);
					// if ( ! empty( $term ) ) {
					// 	echo '<h1 class="entry-title">' . $term->name . '</h1>';
					// } else {
					// 	echo '<h1 class="entry-title">' . __( 'Portfolios', 'unyson' ) . '</h1>';
					// }
					?>

					<?php
					if( function_exists('fw_ext_breadcrumbs') ) {
						fw_ext_breadcrumbs();
					}
					?>

					<?php if ( ! empty( $categories ) ) : ?>
						<div class="wrapp-categories-portfolio">
							<div id="categories-portfolio" class="portfolio-categories">
								<a class="btn btn-warning filter categories-item active" data-filter=".category_all"
										href='#'><?php _e( 'All', 'unyson' ); ?></a>
								<?php foreach ( $categories as $category ) : ?>
									<a class="btn btn-warning filter categories-item"
									    data-filter=".category_<?php echo $category->term_id ?>"
											href='#'><?php echo $category->name; ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif ?>
				</header>
				<div class="entry-content">
					<section class="portfolio" id="Container">
						<?php if ( have_posts() ) : ?>
							<div id="portfolio-list" class="portfolio-list row">
								<?php
								while ( have_posts() ) : the_post();
									include(  fw()->extensions->get( 'portfolio' )->locate_view_path('loop-item') );
								endwhile;
								?>
							</div>
						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
						<div class="clear"></div>
					</section>
				</div>
			</div>
		</section>
	</div>
</div>
<?php
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );
//get_sidebar( 'content' );
//get_sidebar();
get_footer();