<?php
/**
 * Quick view image template.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce; ?>

<div class="kmt-qv-image flexslider images">
	<ul class="kmt-qv-slides slides">
		<?php
		if ( has_post_thumbnail() ) {
			$attachment_ids = $product->get_gallery_image_ids();
			$props          = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$image          = get_the_post_thumbnail(
				$post->ID, 'shop_single', array(
					'title' => $props['title'],
					'alt'   => $props['alt'],
				)
			);
			echo
				sprintf(
					'<li class="%s">%s</li>',
					'woocommerce-product-gallery__image',
					$image
				);

			if ( $attachment_ids ) {
				$loop = 0;

				foreach ( $attachment_ids as $attachment_id ) {

					$props = wc_get_product_attachment_props( $attachment_id, $post );

					if ( ! $props['url'] ) {
						continue;
					}

					echo
						sprintf(
							'<li class="%s">%s</li>',
							'woocommerce-product-gallery__image',
							wp_get_attachment_image( $attachment_id, 'shop_single', 0, $props )
						);

					$loop++;
				}
			}
		} else {
			echo sprintf( '<li><img src="%s" alt="%s" /></li>', wc_placeholder_img_src(), __( 'Placeholder', 'kemet-addons' ) );
		} ?>
	</ul>
</div>