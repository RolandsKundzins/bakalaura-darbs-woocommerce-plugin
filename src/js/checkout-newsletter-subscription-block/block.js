/**
 * External dependencies
 */
import { useEffect, useState } from '@wordpress/element';
import { CheckboxControl } from '@woocommerce/blocks-checkout';
import { getSetting } from '@woocommerce/settings';
import { useSelect, useDispatch } from '@wordpress/data';

const { optInDefaultText } = getSetting(
	'bakalaura-parcel-machine-plugin_data',
	''
);

const Block = ( { children, checkoutExtensionData } ) => {
	const [ checked, setChecked ] = useState( false );
	const { setExtensionData } = checkoutExtensionData;

	const { setValidationErrors, clearValidationError } = useDispatch(
		'wc/store/validation'
	);

	useEffect( () => {
		setExtensionData( 'bakalaura-parcel-machine-plugin', 'optin', checked );
		if ( ! checked ) {
			setValidationErrors( {
				'bakalaura-parcel-machine-plugin': {
					message: 'Please tick the box',
					hidden: false,
				},
			} );
			return;
		}
		clearValidationError( 'bakalaura-parcel-machine-plugin' );
	}, [
		clearValidationError,
		setValidationErrors,
		checked,
		setExtensionData,
	] );

	const { validationError } = useSelect( ( select ) => {
		const store = select( 'wc/store/validation' );
		return {
			validationError: store.getValidationError(
				'bakalaura-parcel-machine-plugin'
			),
		};
	} );

	return (
		<>
			<CheckboxControl
				id="subscribe-to-newsletter"
				checked={ checked }
				onChange={ setChecked }
			>
				{ children || optInDefaultText }
			</CheckboxControl>

			{ validationError?.hidden === false && (
				<div>
					<span role="img" aria-label="Warning emoji">
						⚠️
					</span>
					{ validationError?.message }
				</div>
			) }
		</>
	);
};

export default Block;
