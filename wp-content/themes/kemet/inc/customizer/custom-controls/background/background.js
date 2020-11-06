/* global kemetCustomizerControlBackground */

jQuery(window).on("load", function () {
	jQuery('html').addClass('background-colorpicker-ready');
});

wp.customize.controlConstructor['kmt-background'] = wp.customize.Control.extend({

	// When we're finished loading continue processing
	ready: function () {

		'use strict';

		var control = this;

		// Init the control.
		control.initKmtBgControl();
	},

	initKmtBgControl: function () {

		var control = this,
			defaults = {
				'background-color': "",
				'background-image': "",
				'background-repeat': "repeat",
				'background-position': "center center",
				'background-size': "auto",
				'background-attachment': "scroll",
			},
			value = control.setting._value != '' ? control.setting._value : defaults,
			picker = control.container.find('.kmt-color-control');
		
		// Hide unnecessary controls if the value doesn't have an image.
		if (_.isUndefined(value['background-image']) || '' === value['background-image']) {
			control.container.find('.background-wrapper > .background-repeat').hide();
			control.container.find('.background-wrapper > .background-position').hide();
			control.container.find('.background-wrapper > .background-size').hide();
			control.container.find('.background-wrapper > .background-attachment').hide();
		}
		
		// Color.
		picker.wpColorPicker({
			change: function () {
				if (jQuery('html').hasClass('background-colorpicker-ready')) {
					setTimeout(function () {
						value['background-color'] = picker.val();
						control.saveValue(value);
					}, 100);
				}
			},

			/**
		     * @param {Event} event - standard jQuery event, produced by "Clear"
		     * button.
		     */
			clear: function (event) {
				var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];

				if (element) {
					value['background-color'] = '';
					control.saveValue(value);
				}
			}
		});

		// Background-Repeat.
		control.container.on('change', '.background-repeat select', function () {
			value['background-repeat'] = jQuery(this).val();
			control.saveValue(value);
		});

		// Background-Size.
		control.container.on('change click', '.background-size input', function () {
			value['background-size'] = jQuery(this).val();
			control.saveValue(value);
		});

		// Background-Position.
		control.container.on('change', '.background-position select', function () {
			value['background-position'] = jQuery(this).val();
			control.saveValue(value);
		});

		// Background-Attachment.
		control.container.on('change click', '.background-attachment input', function () {
			value['background-attachment'] = jQuery(this).val();
			control.saveValue(value);
		});

		// Background-Image.
		control.container.on('click', '.background-image-upload-button', function (e) {
			var image = wp.media({ multiple: false }).open().on('select', function () {

				// This will return the selected image from the Media Uploader, the result is an object.
				var uploadedImage = image.state().get('selection').first(),
					previewImage = uploadedImage.toJSON().sizes.full.url,
					imageUrl,
					imageID,
					imageWidth,
					imageHeight,
					preview,
					removeButton;

				if (!_.isUndefined(uploadedImage.toJSON().sizes.medium)) {
					previewImage = uploadedImage.toJSON().sizes.medium.url;
				} else if (!_.isUndefined(uploadedImage.toJSON().sizes.thumbnail)) {
					previewImage = uploadedImage.toJSON().sizes.thumbnail.url;
				}

				imageUrl = uploadedImage.toJSON().sizes.full.url;
				imageID = uploadedImage.toJSON().id;
				imageWidth = uploadedImage.toJSON().width;
				imageHeight = uploadedImage.toJSON().height;

				// Show extra controls if the value has an image.
				if ('' !== imageUrl) {
					control.container.find('.background-wrapper > .background-repeat, .background-wrapper > .background-position, .background-wrapper > .background-size, .background-wrapper > .background-attachment').show();
					control.container.find('.more-settings').attr('data-direction', 'up');
					control.container.find('.message').html(kemetCustomizerControlBackground.lessSettings)
				}

				value['background-image'] = imageUrl;
				control.saveValue(value);
				preview = control.container.find('.placeholder, .thumbnail');
				removeButton = control.container.find('.background-image-upload-remove-button');

				if (preview.length) {
					preview.removeClass().addClass('thumbnail thumbnail-image').html('<img src="' + previewImage + '" alt="" />');
				}
				if (removeButton.length) {
					removeButton.show();
				}
			});

			e.preventDefault();
		});

		control.container.on('click', '.background-image-upload-remove-button', function (e) {

			var preview,
				removeButton;

			e.preventDefault();

			value['background-image'] = '';
			control.saveValue(value);

			preview = control.container.find('.placeholder, .thumbnail');
			removeButton = control.container.find('.background-image-upload-remove-button');

			// Hide unnecessary controls.
			control.container.find('.background-wrapper > .background-repeat').hide();
			control.container.find('.background-wrapper > .background-position').hide();
			control.container.find('.background-wrapper > .background-size').hide();
			control.container.find('.background-wrapper > .background-attachment').hide();

			control.container.find('.more-settings').attr('data-direction', 'down');
			control.container.find('.more-settings').find('.message').html(kemetCustomizerControlBackground.moreSettings);

			if (preview.length) {
				preview.removeClass().addClass('placeholder').html(kemetCustomizerControlBackground.placeholder);
			}
			if (removeButton.length) {
				removeButton.hide();
			}
		});

		control.container.on('click', '.more-settings', function (e) {

			var $this = jQuery(this);
			// Hide unnecessary controls.
			control.container.find('.background-wrapper > .background-repeat').toggle();
			control.container.find('.background-wrapper > .background-position').toggle();
			control.container.find('.background-wrapper > .background-size').toggle();
			control.container.find('.background-wrapper > .background-attachment').toggle();

			if ('down' === $this.attr('data-direction')) {
				$this.attr('data-direction', 'up');
				$this.find('.message').html(kemetCustomizerControlBackground.lessSettings)
			} else {
				$this.attr('data-direction', 'down');
				$this.find('.message').html(kemetCustomizerControlBackground.moreSettings)
			}
		});
	},

	/**
	 * Saves the value.
	 */
	saveValue: function (value) {

		var control = this,
			input = jQuery('#customize-control-' + control.id.replace('[', '-').replace(']', '') + ' .background-hidden-value'),
			val = value;

		jQuery( input ).attr( 'value', JSON.stringify( val ) ).trigger( 'change' );
		
		control.setting.set(val);
	}
});