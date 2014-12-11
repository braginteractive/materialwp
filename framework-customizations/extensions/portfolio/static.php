<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $other_existing_paths
 */

include $other_existing_paths['framework'];

if ( ! is_admin() ) {

	$ext_instance = fw()->extensions->get( 'portfolio' );
	$settings     = $ext_instance->get_settings();

	if ( is_tax( $settings['taxonomy_name'] ) || is_post_type_archive( $settings['post_type'] ) ) {
		wp_enqueue_script(
			'fw-extension-' . $ext_instance->get_name() . '-mixitup',
			$ext_instance->locate_js_URI( 'jquery.mixitup.min' ),
			array( 'jquery' ),
			$ext_instance->manifest->get_version(),
			true
		);
		wp_enqueue_script(
			'fw-extension-' . $ext_instance->get_name() . '-script',
			$ext_instance->locate_js_URI( 'portfolio-script' ),
			array( 'fw-extension-' . $ext_instance->get_name() . '-mixitup' ),
			$ext_instance->manifest->get_version(),
			true
		);

	}

	wp_enqueue_style(
		$ext_instance->get_name() . '-styles',
		$ext_instance->locate_css_URI( 'styles' )
	);
}



