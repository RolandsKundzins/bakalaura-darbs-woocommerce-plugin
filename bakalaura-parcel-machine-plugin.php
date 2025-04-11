<?php
/**
 * Plugin Name:     Bakalaura Parcel Machine Plugin
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     bakalaura-parcel-machine-plugin
 *
 * @package         create-block
 */

add_action(
	'init',
	function () {
		register_block_type_from_metadata( __DIR__ . '/build/js/checkout-newsletter-subscription-block' );
	}
);

add_action(
	'woocommerce_blocks_loaded',
	function () {
		require_once __DIR__ . '/bakalaura-parcel-machine-plugin-blocks-integration.php';
		add_action(
			'woocommerce_blocks_cart_block_registration',
			function ( $integration_registry ) {
				$integration_registry->register( new BakalauraParcelMachinePlugin_Blocks_Integration() );
			}
		);
		add_action(
			'woocommerce_blocks_checkout_block_registration',
			function ( $integration_registry ) {
				$integration_registry->register( new BakalauraParcelMachinePlugin_Blocks_Integration() );
			}
		);
	}
);

/**
 * Registers the slug as a block category with WordPress.
 */
function register_BakalauraParcelMachinePlugin_block_category( $categories ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'bakalaura-parcel-machine-plugin',
				'title' => __( 'BakalauraParcelMachinePlugin Blocks', 'bakalaura-parcel-machine-plugin' ),
			],
		]
	);
}

add_action( 'block_categories_all', 'register_BakalauraParcelMachinePlugin_block_category', 10, 2 );


add_action( 'woocommerce_init', 'BakalauraParcelMachinePlugin_register_custom_checkout_fields' );

/**
 * Registers custom checkout fields for the WooCommerce checkout form.
 *
 * @return void
 * @throws Exception If there is an error during the registration of the checkout fields.
 */
function BakalauraParcelMachinePlugin_register_custom_checkout_fields() {

	if ( ! function_exists( 'woocommerce_register_additional_checkout_field' ) ) {
		return;
	}

	woocommerce_register_additional_checkout_field(
		array(
			'id'       => 'bakalaura-parcel-machine-plugin/custom-checkbox',
			'label'    => 'Check this box to see a custom field on the order.',
			'location' => 'contact',
			'type'     => 'checkbox',
		)
	);

	woocommerce_register_additional_checkout_field(
		array(
			'id'       => 'bakalaura-parcel-machine-plugin/custom-text-input',
			'label'    => "BakalauraParcelMachinePlugin's example text input",
			'location' => 'address',
			'type'     => 'text',
		)
	);

	/**
	 * Sanitizes the value of the custom text input field. For demo purposes we will just turn it to all caps.
	 */
	add_action(
		'woocommerce_sanitize_additional_field',
		function ( $value, $key, $group ) {
			if ( 'bakalaura-parcel-machine-plugin/custom-text-input' === $key ) {
				return strtoupper( $value );
			}
			return $value;
		},
		10,
		3
	);

	/**
	 * Validates the custom text input field. For demo purposes we will not accept the string 'INVALID'.
	 */
	add_action(
		'woocommerce_blocks_validate_location_address_fields',
		function ( \WP_Error $errors, $fields, $group ) {
			if ( 'INVALID' === $fields['bakalaura-parcel-machine-plugin/custom-text-input'] ) {
				$errors->add( 'invalid_text_detected', 'Please ensure your custom text input is not "INVALID".' );
			}
		},
		10,
		3
	);

	woocommerce_register_additional_checkout_field(
		array(
			'id'       => 'bakalaura-parcel-machine-plugin/custom-select-input',
			'label'    => "BakalauraParcelMachinePlugin's example select input",
			'location' => 'order',
			'type'     => 'select',
			'options'  => [
				[
					'label' => 'Option 1',
					'value' => 'option1',
				],
				[
					'label' => 'Option 2',
					'value' => 'option2',
				],
			],
		)
	);
}
