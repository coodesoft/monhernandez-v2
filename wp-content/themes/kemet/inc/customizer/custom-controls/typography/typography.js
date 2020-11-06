
/**
 * File typography.js
 *
 * Handles Typography of the site
 *
 * @package Kemet
 */

(function ($) {

	/* Internal shorthand */
	var api = wp.customize;

	/**
	 * Helper class for the main Customizer interface.
	 *
	 * @class KmtTypography
	 */
	KmtTypography = {
		/**
		 * Initializes our custom logic for the Customizer.
		 *
		 * @method init
		 */
		init: function () {
			KmtTypography._initFonts();
		},

		/**
		 * Initializes logic for font controls.
		 *
		 * @access private
		 * @method _initFonts
		 */
		_initFonts: function () {
			$('.customize-control-kmt-font-family select').each(KmtTypography._initFont);
			$('.customize-control-kmt-font-family select').selectWoo();
		},

		/**
		 * Initializes logic for a single font control.
		 *
		 * @access private
		 * @method _initFont
		 */
		_initFont: function () {
			var select = $(this),
				link = select.data('customize-setting-link'),
				weight = select.data('connected-control');

			if ('undefined' != typeof weight) {
				api(link).bind(KmtTypography._fontSelectChange);
				KmtTypography._setFontWeightOptions.apply(api(link), [true]);
			}

		},

		/**
		 * Callback for when a font control changes.
		 *
		 * @access private
		 * @method _fontSelectChange
		 */
		_fontSelectChange: function () {
			KmtTypography._setFontWeightOptions.apply(this, [false]);

		},

		/**
		 * Clean font name.
		 *
		 * Google Fonts are saved as {'Font Name', Category}. This function cleanes this up to retreive only the {Font Name}.
		 *
		 * @param  {String} fontValue Name of the font.
		 * 
		 * @return {String}  Font name where commas and inverted commas are removed if the font is a Google Font.
		 */
		_cleanGoogleFonts: function (fontValue) {
			// Bail if fontVAlue does not contain a comma.
			if (!fontValue.includes(',')) return fontValue;

			var splitFont = fontValue.split(',');
			var pattern = new RegExp("'", 'gi');

			// Check if the cleaned font exists in the Google fonts array.
			var googleFontValue = splitFont[0].replace(pattern, '');
			if ('undefined' != typeof KmtFontFamilies.google[googleFontValue]) {
				fontValue = googleFontValue;
			}

			return fontValue;
		},

		/**
		 * Sets the options for a font weight control when a
		 * font family control changes.
		 *
		 * @access private
		 * @method _setFontWeightOptions
		 * @param {Boolean} init Whether or not we're initializing this font weight control.
		 */
		_setFontWeightOptions: function (init) {
			var i = 0,
				fontSelect = api.control(this.id).container.find('select'),
				fontValue = this(),
				selected = '',
				weightKey = fontSelect.data('connected-control'),
				inherit = fontSelect.data('inherit'),
				weightSelect = api.control(weightKey).container.find('select'),
				currentWeightTitle = weightSelect.data('inherit'),
				weightValue = init ? weightSelect.val() : '400',
				inheritWeightObject = ['inherit'],
				weightObject = ['400', '600'],
				weightOptions = '',
				weightMap = kemetTypo;
			if (fontValue == 'inherit') {
				weightValue = init ? weightSelect.val() : 'inherit';
			}
			var fontValue = KmtTypography._cleanGoogleFonts(fontValue);

			if (fontValue == 'inherit') {
				weightObject = ['400', '500', '600', '700'];
			} else if ('undefined' != typeof KmtFontFamilies.system[fontValue]) {
				weightObject = KmtFontFamilies.system[fontValue].weights;
			} else if ('undefined' != typeof KmtFontFamilies.google[fontValue]) {
				weightObject = KmtFontFamilies.google[fontValue][0];
				weightObject = Object.keys(weightObject).map(function (k) {
					return weightObject[k];
				});
			} else if ('undefined' != typeof KmtFontFamilies.custom[fontValue.split(',')[0]]) {
				weightObject = KmtFontFamilies.custom[fontValue.split(',')[0]].weights;
			}

			weightObject = $.merge(inheritWeightObject, weightObject)
			weightMap['inherit'] = currentWeightTitle;
			for (; i < weightObject.length; i++) {

				if (0 === i && -1 === $.inArray(weightValue, weightObject)) {
					weightValue = weightObject[0];
					selected = ' selected="selected"';
				} else {
					selected = weightObject[i] == weightValue ? ' selected="selected"' : '';
				}
				if ('undefined' != typeof weightMap[weightObject[i]]){
					weightOptions += '<option value="' + weightObject[i] + '"' + selected + '>' + weightMap[weightObject[i]] + '</option>';
				}
			}

			weightSelect.html(weightOptions);

			if (!init) {
				api(weightKey).set('');
				api(weightKey).set(weightValue);
			}
		},
	};

	$(function () { KmtTypography.init(); });
	$(function () {
		//Inline Style
		var font_weight_controls = jQuery('#customize-theme-controls').find('.customize-control-kmt-font-weight');
		font_weight_controls.each(function () {
			var font_weight_control = jQuery(this);
			var font_tranform_control = font_weight_control.next('.customize-control-select');

			font_weight_control.addClass('controls-inline');
			font_weight_control.css('padding-right', '5px');
			font_tranform_control.addClass('controls-inline');
			font_tranform_control.css('padding-left', '5px');
		})

	});
})(jQuery);