/**
 * External dependencies
 */
import { registerCheckoutFilters } from '@woocommerce/blocks-checkout';
import { registerPaymentMethodExtensionCallbacks } from '@woocommerce/blocks-registry';

export const registerFilters = () => {
	registerCheckoutFilters( 'bakalaura-parcel-machine-plugin', {
		itemName: ( name ) => {
			return `${ name } + extra data!`;
		},
	} );

	registerPaymentMethodExtensionCallbacks(
		'bakalaura-parcel-machine-plugin',
		{
			cod: ( arg ) => arg.billingData.city !== 'Denver',
		}
	);
};
