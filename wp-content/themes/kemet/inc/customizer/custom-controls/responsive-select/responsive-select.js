/**
 * File responsive.js
 *
 * Handles the responsive
 *
 * @package Kemet
 */

wp.customize.controlConstructor['kmt-responsive-select'] = wp.customize.Control.extend({

	// When we're finished loading continue processing.
	ready: function () {

		'use strict';

		var control = this,
			value;

		control.kmtResponsiveInit();

		/**
		 * Save on change / keyup / paste
		 */
		this.container.on('change keyup paste', 'select.kmt-responsive-select', function () {

			value = jQuery(this).val();

			// Update value on change.
			control.updateValue();
		});

		/**
		 * Refresh preview frame on blur
		 */
		this.container.on('blur', 'input', function () {

			value = jQuery(this).val() || '';

			if (value == '') {
				wp.customize.previewer.refresh();
			}

		});

	},

	/**
	 * Updates the sorting list
	 */
	updateValue: function () {

		'use strict';

		var control = this,
			newValue = {};

		// Set the spacing container.
		control.responsiveContainer = control.container.find('.kmt-responsive-wrapper').first();

		control.responsiveContainer.find('select.kmt-responsive-select').each(function () {
			var responsive_input = jQuery(this),
				item = responsive_input.data('id'),
				item_value = responsive_input.val();

			newValue[item] = item_value;
		});
		
		control.setting.set(newValue);
	},

	kmtResponsiveInit: function () {

		'use strict';

		var control = this;

		this.container.on('click', '.kmt-responsive-slider-btns button', function (event) {

			event.preventDefault();

			var device = jQuery(this).attr('data-device');
	
			if ('desktop' == device) {
				device = 'tablet';
			} else if ('tablet' == device) {
				device = 'mobile';
			} else {
				device = 'desktop';
			}

			jQuery('.wp-full-overlay-footer .devices button[data-device="' + device + '"]').trigger('click');
		});
	},
});

jQuery(' .wp-full-overlay-footer .devices button ').on('click', function () {

	var device = jQuery(this).attr('data-device');

	jQuery('.customize-control-kmt-responsive-select .input-wrapper select, .customize-control .kmt-responsive-btns > li').removeClass('active');
	jQuery('.customize-control-kmt-responsive-select .input-wrapper select.' + device + ', .customize-control .kmt-responsive-btns > li.' + device).addClass('active');
});
