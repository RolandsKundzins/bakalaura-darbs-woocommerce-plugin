/**
 * External dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { ExperimentalOrderMeta } from '@woocommerce/blocks-checkout';
import { getSetting } from '@woocommerce/settings';
/**
 * Internal dependencies
 */
import './style.scss';

import { registerFilters } from './filters';
import { ExampleComponent } from './ExampleComponent';

const exampleDataFromSettings = getSetting(
	'bakalaura-parcel-machine-plugin_data'
);

const render = () => {
	return (
		<>
			<ExperimentalOrderMeta>
				<ExampleComponent data={ exampleDataFromSettings } />
			</ExperimentalOrderMeta>
		</>
	);
};

registerPlugin( 'bakalaura-parcel-machine-plugin', {
	render,
	scope: 'woocommerce-checkout',
} );

registerFilters();
