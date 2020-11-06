(function ($) {
    /**
	 * Sale
	 */
	wp.customize('kemet-settings[sale-style]', function (setting) {
		setting.bind(function (radius) {

			var dynamicStyle = '.woocommerce .product .onsale { border-radius: ' + (parseInt(radius)) + '% }';

				
			kemet_add_dynamic_css('sale-style', dynamicStyle);

		});
	});
	/**
	 * Image Width
	 */
	wp.customize('kemet-settings[product-image-width]', function (setting) {
		setting.bind(function (width) {

			var dynamicStyle = '@media only screen and (min-width: 768px){ .woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images { width: ' + (parseInt(width)) + '% }';
			dynamicStyle += '.woocommerce #content .kmt-woocommerce-container div.product div.images,.woocommerce .kmt-woocommerce-container div.product div.images { max-width: ' + (parseInt(width)) + '% }';
			
			dynamicStyle += '.woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary { width: ' + (parseInt(100 - width) - 3) + '% }';
			dynamicStyle += '.woocommerce #content .kmt-woocommerce-container div.product div.summary,.woocommerce .kmt-woocommerce-container div.product div.summary { max-width: ' + (parseInt(100 - width) - 3) + '% } }';	

			kemet_add_dynamic_css('product-image-width', dynamicStyle);

		});
	});

	kemet_css('kemet-settings[infinite-scroll-loader-color]', 'background-color', '.kmt-infinite-scroll-loader .kmt-infinite-scroll-dots .kmt-loader');
})(jQuery);
