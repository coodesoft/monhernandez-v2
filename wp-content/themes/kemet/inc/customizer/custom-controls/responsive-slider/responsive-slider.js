/**
 * File slider.js
 *
 * Handles Slider control
 *
 * @package Kemet
 */

wp.customize.controlConstructor['kmt-responsive-slider'] = wp.customize.Control.extend({

	ready: function () {

		'use strict';

		var control = this,
			value,
			thisInput,
			inputDefault,
			changeAction;

		control.kmtResponsiveInit();

		// Update the text value.
		this.container.on('input change', 'input[type=range]', function () {
			var value = jQuery(this).val(),
				input_number = jQuery(this).closest('.input-field-wrapper').find('.kmt-responsive-range-value-input');

			input_number.val(value);
			input_number.trigger('change');
		});

		// Handle the reset button.
		this.container.on('click', '.kmt-responsive-slider-reset', function () {

			var wrapper = jQuery(this).parent().find('.input-field-wrapper.active'),
				input_range = wrapper.find('input[type=range]'),
				input_number = wrapper.find('.kmt-responsive-range-value-input'),
				default_value = input_range.data('reset_value');

			input_range.val(default_value);
			input_number.val(default_value);
			input_number.trigger('change');
		});

		// Save changes.
		this.container.on('input change', 'input[type=number]', function () {
			var value = jQuery(this).val();
			jQuery(this).closest('.input-field-wrapper').find('input[type=range]').val(value);

			control.updateValue();
		});
	},

	/**
	 * Updates the sorting list
	 */
	updateValue: function () {

		'use strict';

		var control = this,
			newValue = {
				'desktop': '',
				'tablet': '',
				'mobile': '',
				'desktop-unit': 'px',
				'tablet-unit': 'px',
				'mobile-unit': 'px',
			};

		// Set the Slider container.
		control.responsiveContainer = control.container.find('.wrapper').first();

		control.responsiveContainer.find('.kmt-responsive-range-value-input').each(function () {
			var responsive_input = jQuery(this),
				item = responsive_input.data('id'),
				item_value = responsive_input.val();

			newValue[item] = item_value;

		});
		control.container.find('.kmt-slider-unit-wrapper .kmt-slider-unit-input').each(function () {
			var slider_unit = jQuery(this),
				device = slider_unit.attr('data-device'),
				device_val = slider_unit.val(),
				name = device + '-unit';

			newValue[name] = device_val;
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

		// Unit click
		control.container.on('click', '.kmt-slider-responsive-units .single-unit', function () {

			var $this = jQuery(this);

			if ($this.hasClass('active')) {
				return false;
			}
			var unit_value = $this.attr('data-unit'),
				unit_min = $this.attr('data-min'),
				unit_max = $this.attr('data-max'),
				unit_step = $this.attr('data-step'),
				device = jQuery('.wp-full-overlay-footer .devices button.active').attr('data-device');

			$this.siblings().removeClass('active');
			$this.addClass('active');
			control.container.find('.input-field-wrapper.' + device + ' .kmt-responsive-range-' + device + '-input ,.input-field-wrapper.' + device + ' input[type=range]').attr('min', unit_min);
			control.container.find('.input-field-wrapper.' + device + ' .kmt-responsive-range-' + device + '-input ,.input-field-wrapper.' + device + ' input[type=range]').attr('max', unit_max);
			control.container.find('.input-field-wrapper.' + device + ' .kmt-responsive-range-' + device + '-input ,.input-field-wrapper.' + device + ' input[type=range]').attr('step', unit_step);
			control.container.find('.input-field-wrapper.' + device + ' .kmt-responsive-range-' + device + '-input ,.input-field-wrapper.' + device + ' input[type=range]').val('');

			control.container.find('.kmt-slider-unit-wrapper .kmt-slider-' + device + '-unit').val(unit_value);

			// Update value on change.
			control.updateValue();
		});
	},
});

jQuery(' .wp-full-overlay-footer .devices button ').on('click', function () {

	var device = jQuery(this).attr('data-device');

	jQuery('.customize-control-kmt-responsive-slider .input-field-wrapper, .customize-control .kmt-responsive-slider-btns > li').removeClass('active');
	jQuery('.customize-control-kmt-responsive-slider .input-field-wrapper.' + device + ', .customize-control .kmt-responsive-slider-btns > li.' + device).addClass('active');
});
