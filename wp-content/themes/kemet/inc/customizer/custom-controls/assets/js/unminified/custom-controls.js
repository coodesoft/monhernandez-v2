/**
 * File sortable.js
 *
 * Handles sortable list
 *
 * @package Kemet
 */

	wp.customize.controlConstructor['kmt-sortable'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this;

			// Set the sortable container.
			control.sortableContainer = control.container.find( 'ul.sortable' ).first();

			// Init sortable.
			control.sortableContainer.sortable({

				// Update value when we stop sorting.
				stop: function() {
					control.updateValue();
				}
			}).disableSelection().find( 'li' ).each( function() {

					// Enable/disable options when we click on the eye of Thundera.
					jQuery( this ).find( 'i.visibility' ).click( function() {
						jQuery( this ).toggleClass( 'dashicons-visibility-faint' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
					});
			}).click( function() {

				// Update value on click.
				control.updateValue();
			});
		},

		/**
		 * Updates the sorting list
		 */
		updateValue: function() {

			'use strict';

			var control = this,
		    newValue = [];

			this.sortableContainer.find( 'li' ).each( function() {
				if ( ! jQuery( this ).is( '.invisible' ) ) {
					newValue.push( jQuery( this ).data( 'value' ) );
				}
			});

			control.setting.set( newValue );
		}
	});

/**
 * File slider.js
 *
 * Handles Slider control
 *
 * @package Kemet
 */

wp.customize.controlConstructor['kmt-slider'] = wp.customize.Control.extend({

	ready: function () {

		'use strict';

		var control = this,
			value,
			thisInput,
			inputDefault,
			changeAction;

		
		// Update the text value.
		this.container.on('input change', 'input[type=range]', function () {
			var value = jQuery(this).val(),
				input_number = jQuery(this).closest('.wrapper').find('input[type=number]');
			
			input_number.val(value);
			input_number.change();
		});
		// Handle the reset button.
		jQuery('.kmt-slider-reset').click(function () {
			var wrapper = jQuery(this).closest('.wrapper'),
				input_range = wrapper.find('input[type=range]'),
				input_number = wrapper.find('.kemet_range_value .value'),
				default_value = input_range.data('reset_value');

			input_range.val(default_value);
			input_number.val(default_value);
			input_number.change();
		});
		// Save changes.
		this.container.on('input change', 'input[type=number]', function () {
			var value = jQuery(this).val();
			jQuery(this).closest('.wrapper').find('input[type=range]').val(value);
			control.setting.set(value);
		});
	}
});

/**
 * File slider.js
 *
 * Handles Slider control
 *
 * @package Kemet
 */

jQuery(window).on("load", function() {
  	jQuery('html').addClass('colorpicker-ready');
});

	wp.customize.controlConstructor['kmt-color'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this,
				value,
				thisInput,
				inputDefault,
				changeAction;			

			this.container.find('.kmt-color-picker-alpha' ).wpColorPicker({
				/**
			     * @param {Event} event - standard jQuery event, produced by whichever
			     * control was changed.
			     * @param {Object} ui - standard jQuery UI object, with a color member
			     * containing a Color.js object.
			     */
			    change: function (event, ui) {
			        var element = event.target;
			        var color = ui.color.toString();

			        if ( jQuery('html').hasClass('colorpicker-ready') ) {
						control.setting.set( color );
			        }
			    },

			    /**
			     * @param {Event} event - standard jQuery event, produced by "Clear"
			     * button.
			     */
			    clear: function (event) {
			        var element = jQuery(event.target).closest('.wp-picker-input-wrap').find('.wp-color-picker')[0];
			        var color = '';

			        if (element) {
			            // Add your code here
			        	control.setting.set( color );
			        }
			    }
			});
		}
	});

/**
 * File icon-select.js
 *
 * Handles Icon Select
 *
 * @package Kemet
 */
wp.customize.controlConstructor['kmt-icon-select'] = wp.customize.Control.extend({

    ready: function () {

        'use strict';

        var control = this;

        // Change the value
        this.container.on('change', 'input', function () {
            control.setting.set(jQuery(this).val());
        });

    }

});
/**
 * File radio-image.js
 *
 * Handles toggling the radio images button
 *
 * @package Kemet
 */

	wp.customize.controlConstructor['kmt-radio-image'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this;

			// Change the value.
			this.container.on( 'click', 'input', function() {
				control.setting.set( jQuery( this ).val() );
			});

		}

	});

/**
 * File responsive.js
 *
 * Handles the responsive
 *
 * @package Kemet
 */

	wp.customize.controlConstructor['kmt-responsive'] = wp.customize.Control.extend({

		// When we're finished loading continue processing.
		ready: function() {

			'use strict';

			var control = this,
		    value;

			control.kmtResponsiveInit();
			
			/**
			 * Save on change / keyup / paste
			 */
			this.container.on( 'change keyup paste', 'input.kmt-responsive-input, select.kmt-responsive-select', function() {

				value = jQuery( this ).val();

				// Update value on change.
				control.updateValue();
			});

			/**
			 * Refresh preview frame on blur
			 */
			this.container.on( 'blur', 'input', function() {

				value = jQuery( this ).val() || '';

				if ( value == '' ) {
					wp.customize.previewer.refresh();
				}

			});

		},

		/**
		 * Updates the sorting list
		 */
		updateValue: function() {

			'use strict';

			var control = this,
		    newValue = {};

		    // Set the spacing container.
			control.responsiveContainer = control.container.find( '.kmt-responsive-wrapper' ).first();

			control.responsiveContainer.find( 'input.kmt-responsive-input' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;

			});

			control.responsiveContainer.find( 'select.kmt-responsive-select' ).each( function() {
				var responsive_input = jQuery( this ),
				item = responsive_input.data( 'id' ),
				item_value = responsive_input.val();

				newValue[item] = item_value;
			});

			control.setting.set( newValue );
		},

		kmtResponsiveInit : function() {
			
			'use strict';
			this.container.find( '.kmt-responsive-btns button' ).on( 'click', function( event ) {

				var device = jQuery(this).attr('data-device');
				if( 'desktop' == device ) {
					device = 'tablet';
				} else if( 'tablet' == device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});
		},
	});
	
	jQuery(' .wp-full-overlay-footer .devices button ').on('click', function() {

		var device = jQuery(this).attr('data-device');

		jQuery( '.customize-control-kmt-responsive .input-wrapper input, .customize-control .kmt-responsive-btns > li' ).removeClass( 'active' );
		jQuery( '.customize-control-kmt-responsive .input-wrapper input.' + device + ', .customize-control .kmt-responsive-btns > li.' + device ).addClass( 'active' );
	});

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

/**
 * File spacing.js
 *
 * Handles the spacing
 *
 * @package Kemet
 */

	wp.customize.controlConstructor['kmt-responsive-spacing'] = wp.customize.Control.extend({

		ready: function() {

			'use strict';

			var control = this,
		    value;
		    
		    control.kmtResponsiveInit();

			// Save the value.
			this.container.on( 'change keyup paste', 'input.kmt-spacing-input', function() {

				value = jQuery( this ).val();

				// Update value on change.
				control.updateValue();
			});
		},

		/**
		 * Updates the spacing values
		 */
		updateValue: function() {

			'use strict';

			var control = this,
				newValue = {
					'desktop' 		: {},
					'tablet'  		: {},
					'mobile'  		: {},
					'desktop-unit'	: 'px',
					'tablet-unit'	: 'px',
					'mobile-unit'	: 'px',
				};

			control.container.find( 'input.kmt-spacing-desktop' ).each( function() {
				var spacing_input = jQuery( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['desktop'][item] = item_value;
			});

			control.container.find( 'input.kmt-spacing-tablet' ).each( function() {
				var spacing_input = jQuery( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['tablet'][item] = item_value;
			});

			control.container.find( 'input.kmt-spacing-mobile' ).each( function() {
				var spacing_input = jQuery( this ),
				item = spacing_input.data( 'id' ),
				item_value = spacing_input.val();

				newValue['mobile'][item] = item_value;
			});

			control.container.find('.kmt-spacing-unit-wrapper .kmt-spacing-unit-input').each( function() {
				var spacing_unit 	= jQuery( this ),
					device 			= spacing_unit.attr('data-device'),
					device_val 		= spacing_unit.val(),
					name 			= device + '-unit';
					
				newValue[ name ] = device_val;
			});

			control.setting.set( newValue );
		},

		/**
		 * Set the responsive devices fields
		 */
		kmtResponsiveInit : function() {
			
			'use strict';

			var control = this;
			
			control.container.find( '.kmt-spacing-responsive-btns button' ).on( 'click', function( event ) {

				var device = jQuery(this).attr('data-device');
				if( 'desktop' == device ) {
					device = 'tablet';
				} else if( 'tablet' == device ) {
					device = 'mobile';
				} else {
					device = 'desktop';
				}

				jQuery( '.wp-full-overlay-footer .devices button[data-device="' + device + '"]' ).trigger( 'click' );
			});

			// Unit click
			control.container.on( 'click', '.kmt-spacing-responsive-units .single-unit', function() {
				
				var $this 		= jQuery(this);

				if ( $this.hasClass('active') ) {
					return false;
				}

				var	unit_value 	= $this.attr('data-unit'),
					device 		= jQuery('.wp-full-overlay-footer .devices button.active').attr('data-device');
				
				$this.siblings().removeClass('active');
				$this.addClass('active');

				control.container.find('.kmt-spacing-unit-wrapper .kmt-spacing-' + device + '-unit').val( unit_value );

				// Update value on change.
				control.updateValue();
			});
		},
	});

	jQuery( document ).ready( function( ) {

		// Connected button
		jQuery( '.kmt-spacing-connected' ).on( 'click', function() {

			// Remove connected class
			jQuery(this).parent().parent( '.kmt-spacing-wrapper' ).find( 'input' ).removeClass( 'connected' ).attr( 'data-element-connect', '' );
			
			// Remove class
			jQuery(this).parent( '.kmt-spacing-input-item-link' ).removeClass( 'disconnected' );

		} );

		// Disconnected button
		jQuery( '.kmt-spacing-disconnected' ).on( 'click', function() {

			// Set up variables
			var elements 	= jQuery(this).data( 'element-connect' );
			
			var linkedInputs = jQuery(this).parent().parent('.kmt-spacing-wrapper').find('.kmt-spacing-input');

			linkedInputs.each(function(){
				var input_val = jQuery(this).val();
				if (input_val != ''){
					jQuery(this).parent().parent('.kmt-spacing-wrapper').find('.kmt-spacing-input').each(function (key, value) {
						jQuery(this).val(input_val).change();
					});
				}
			});

			// Add connected class
			jQuery(this).parent().parent( '.kmt-spacing-wrapper' ).find( 'input' ).addClass( 'connected' ).attr( 'data-element-connect', elements );

			// Add class
			jQuery(this).parent( '.kmt-spacing-input-item-link' ).addClass( 'disconnected' );

		} );

		// Values connected inputs
		jQuery( '.kmt-spacing-input-item' ).on( 'input', '.connected', function() {

			var dataElement 	  = jQuery(this).attr( 'data-element-connect' ),
				currentFieldValue = jQuery( this ).val();

			jQuery(this).parent().parent( '.kmt-spacing-wrapper' ).find( '.connected[ data-element-connect="' + dataElement + '" ]' ).each( function( key, value ) {
				jQuery(this).val( currentFieldValue ).change();
			} );

		} );
	});

	jQuery('.wp-full-overlay-footer .devices button ').on('click', function() {

		var device = jQuery(this).attr('data-device');
		jQuery( '.customize-control-kmt-responsive-spacing .input-wrapper .kmt-spacing-wrapper, .customize-control .kmt-spacing-responsive-btns > li' ).removeClass( 'active' );
		jQuery( '.customize-control-kmt-responsive-spacing .input-wrapper .kmt-spacing-wrapper.' + device + ', .customize-control .kmt-spacing-responsive-btns > li.' + device ).addClass( 'active' );
	});
