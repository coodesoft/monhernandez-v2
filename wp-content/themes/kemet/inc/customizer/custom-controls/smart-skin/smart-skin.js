/**
 * File smart-skin.js
 *
 * Handles the smart-skin
 *
 * @package Kemet
 */

wp.customize.controlConstructor['kmt-smart-skin'] = wp.customize.Control.extend({

	// When we're finished loading continue processing.
	ready: function () {

		'use strict';

		var control = this,
			value = '' ;
			
		// Change the value.
		this.container.on('click', 'input', function () {
			var colors = jQuery(this).data('colors');
			control.updateColors(colors);
			control.setting.set(jQuery(this).val());
		});

	},

	updateColors: function(colors){
		jQuery.each(colors , function(index , value){
			color_control = wp.customize.control(index);
			color_control.container.find('input.wp-color-picker').val(value);
			color_control.container.find('input.wp-color-picker').iris('color', value);
			color_control.setting.set(value)
		});
	},
});
