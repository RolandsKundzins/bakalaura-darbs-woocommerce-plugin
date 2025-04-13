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
			'id'       => 'bakalaura-parcel-machine-plugin/parcel-machine-selector',
			'label'    => 'Choose Parcel Machine',
			'location' => 'order',
			'type'     => 'select',
			'options'  => [
				[
					'label' => 'Parcel Machine 1 - Main Street 123',
					'value' => 'machine_1',
				],
				[
					'label' => 'Parcel Machine 2 - Elm Street 456',
					'value' => 'machine_2',
				],
                [
					'label' => 'Parcel Machine 3 - Oak Avenue 789',
					'value' => 'machine_3',
				],
			],
		)
	);
}


add_action('woocommerce_set_additional_field_value', function($key, $value, $group, $wc_object) {
    if ($key === 'bakalaura-parcel-machine-plugin/parcel-machine-selector') {
        $order_id = $wc_object->get_id();
        error_log('Order ID: ' . $order_id . ' - Selected Parcel Machine: ' . $value);
        // Datus iespējams tālāk izmantot, piemēram, saglabāt datubāzē vai nosūtīt uz lietojumprogrammu saskarni (API).
    }
}, 10, 4);
