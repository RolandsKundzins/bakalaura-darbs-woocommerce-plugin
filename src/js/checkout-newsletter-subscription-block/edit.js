/**
 * External dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	InspectorControls,
} from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { CheckboxControl } from '@woocommerce/blocks-checkout';
import { getSetting } from '@woocommerce/settings';
/**
 * Internal dependencies
 */
import './style.scss';
const { optInDefaultText } = getSetting(
	'bakalaura-parcel-machine-plugin_data',
	''
);

export const Edit = ( { attributes, setAttributes } ) => {
	const { text } = attributes;
	const blockProps = useBlockProps();
	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody
					title={ __(
						'Block options',
						'bakalaura-parcel-machine-plugin'
					) }
				>
					Options for the block go here.
				</PanelBody>
			</InspectorControls>
			<CheckboxControl
				id="newsletter-text"
				checked={ false }
				disabled={ true }
			/>
			<RichText
				value={ text || optInDefaultText }
				onChange={ ( value ) => setAttributes( { text: value } ) }
			/>
		</div>
	);
};

export const Save = ( { attributes } ) => {
	const { text } = attributes;
	return (
		<div { ...useBlockProps.save() }>
			<RichText.Content value={ text || optInDefaultText } />
		</div>
	);
};
