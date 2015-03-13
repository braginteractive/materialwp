<?php
/**
 * Search Form Template
 *
 */
?>

<form method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row">
		<div class="col-lg-12">
			<input type="text" class="form-control search-query floating-label" name="s" placeholder="<?php esc_attr_e('Search', 'materialwp'); ?>" />
		</div>
	</div>
</form>

