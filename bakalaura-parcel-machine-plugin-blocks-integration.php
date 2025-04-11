<?php
use Automattic\WooCommerce\Blocks\Integrations\IntegrationInterface;

define ( 'BakalauraParcelMachinePlugin_VERSION', '0.1.0' );

/**
 * Class for integrating with WooCommerce Blocks
 */
class BakalauraParcelMachinePlugin_Blocks_Integration implements IntegrationInterface {

	/**
	 * The name of the integration.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bakalaura-parcel-machine-plugin';
	}

	/**
	 * When called invokes any initialization/setup for the integration.
	 */
	public function initialize() {
		$this->register_newsletter_block_frontend_scripts();
		$this->register_newsletter_block_editor_scripts();
        $this->register_newsletter_block_editor_styles();
        $this->register_main_integration();
	}

	/**
	 * Registers the main JS file required to add filters and Slot/Fills.
	 */
	public function register_main_integration() {
		$script_path = '/build/index.js';
		$style_path  = '/build/style-index.css';

		$script_url = plugins_url( $script_path, __FILE__ );
		$style_url  = plugins_url( $style_path, __FILE__ );

		$script_asset_path = dirname( __FILE__ ) . '/build/index.asset.php';
		$script_asset      = file_exists( $script_asset_path )
			? require $script_asset_path
			: array(
				'dependencies' => array(),
				'version'      => $this->get_file_version( $script_path ),
			);

		wp_enqueue_style(
			'bakalaura-parcel-machine-plugin-blocks-integration',
			$style_url,
			[],
			$this->get_file_version( $style_path )
		);

		wp_register_script(
			'bakalaura-parcel-machine-plugin-blocks-integration',
			$script_url,
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);
		wp_set_script_translations(
			'bakalaura-parcel-machine-plugin-blocks-integration',
			'bakalaura-parcel-machine-plugin',
			dirname( __FILE__ ) . '/languages'
		);
	}

	/**
	 * Returns an array of script handles to enqueue in the frontend context.
	 *
	 * @return string[]
	 */
	public function get_script_handles() {
		return array( 'bakalaura-parcel-machine-plugin-blocks-integration', 'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-frontend' );
	}

	/**
	 * Returns an array of script handles to enqueue in the editor context.
	 *
	 * @return string[]
	 */
	public function get_editor_script_handles() {
		return array( 'bakalaura-parcel-machine-plugin-blocks-integration', 'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-editor' );
	}

	/**
	 * An array of key, value pairs of data made available to the block on the client side.
	 *
	 * @return array
	 */
	public function get_script_data() {
		$data = array(
			'bakalaura-parcel-machine-plugin-active' => true,
			'example-data' => __( 'This is some example data from the server', 'bakalaura-parcel-machine-plugin' ),
            'optInDefaultText' => __( 'I want to receive updates about products and promotions.', 'bakalaura-parcel-machine-plugin' ),
		);

		return $data;

	}

    public function register_newsletter_block_editor_styles() {
        $style_path  = '/build/style-bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block.css';

        $style_url  = plugins_url( $style_path, __FILE__ );
        wp_enqueue_style(
            'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block',
            $style_url,
            [],
            $this->get_file_version( $style_path )
        );
    }

    public function register_newsletter_block_editor_scripts() {
        $script_path       = '/build/bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block.js';
        $script_url        = plugins_url( $script_path, __FILE__ );
        $script_asset_path = dirname( __FILE__ ) . '/build/bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block.asset.php';
        $script_asset      = file_exists( $script_asset_path )
            ? require $script_asset_path
            : array(
                'dependencies' => array(),
                'version'      => $this->get_file_version( $script_asset_path ),
            );

        wp_register_script(
            'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-editor',
            $script_url,
            $script_asset['dependencies'],
            $script_asset['version'],
            true
        );

        wp_set_script_translations(
            'bakalaura-parcel-machine-plugin-newsletter-block-editor', // script handle
            'bakalaura-parcel-machine-plugin', // text domain
            dirname( __FILE__ ) . '/languages'
        );
    }

    public function register_newsletter_block_frontend_scripts() {
        $script_path       = '/build/bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-frontend.js';
        $script_url        = plugins_url( $script_path, __FILE__ );
        $script_asset_path = dirname( __FILE__ ) . '/build/newsletter-block-frontend.asset.php';
        $script_asset      = file_exists( $script_asset_path )
            ? require $script_asset_path
            : array(
                'dependencies' => array(),
                'version'      => $this->get_file_version( $script_asset_path ),
            );

        wp_register_script(
            'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-frontend',
            $script_url,
            $script_asset['dependencies'],
            $script_asset['version'],
            true
        );
        wp_set_script_translations(
            'bakalaura-parcel-machine-plugin-checkout-newsletter-subscription-block-frontend', // script handle
            'bakalaura-parcel-machine-plugin', // text domain
            dirname( __FILE__ ) . '/languages'
        );
    }

	/**
	 * Get the file modified time as a cache buster if we're in dev mode.
	 *
	 * @param string $file Local path to the file.
	 * @return string The cache buster value to use for the given file.
	 */
	protected function get_file_version( $file ) {
		if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG && file_exists( $file ) ) {
			return filemtime( $file );
		}
		return BakalauraParcelMachinePlugin_VERSION;
	}
}
