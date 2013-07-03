<?php
/**
 * Implements a custom header for Travelify.
 * See http://codex.wordpress.org/Custom_Headers
 *
 */

add_action( 'after_setup_theme', 'travelify_custom_header_setup' );
/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses travelify_header_style() to style front-end.
 * @uses travelify_admin_header_style() to style wp-admin form.
 * @uses travelify_admin_header_image() to add custom markup to wp-admin form.
 *
 */
function travelify_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => apply_filters( 'travelify_header_image_height', 250 ),
		'width'                  => apply_filters( 'travelify_header_image_width', 1038 ),
		'max-width'              => 2000,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// No Header Text Feature
		'header-text'				 => false,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => '',
		'admin-head-callback'    => 'travelify_admin_header_style',
		'admin-preview-callback' => 'travelify_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 */

function travelify_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 */

function travelify_admin_header_image() {
	?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }