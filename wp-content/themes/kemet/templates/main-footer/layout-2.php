<?php
/**
 * Footer Layout 2
 *
 * @since   Kemet 1.0.0
 */

/**
 * Hide main footer markup if:
 *
 * - User is not logged in. [AND]
 * - All widgets are not active.
 */
if ( ! is_user_logged_in() ) {
	if (
		! is_active_sidebar( 'main-footer-widget-1' ) &&
		! is_active_sidebar( 'main-footer-widget-2' ) 
	) {
		return;
	}
}

$classes[] = 'kemet-footer';
$classes[] = 'kemet-footer-layout-2';
if(kemet_get_option('enable-footer-content-center')) {
	$classes[] = 'kemet-footer-align-center';
}
$classes   = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<div class="kemet-footer-overlay">
		<div class="kmt-container">
			<div class="kmt-row">
				<div class="kmt-col-lg-6 kmt-col-md-6 kmt-col-sm-12 kmt-col-xs-12 kemet-footer-widget kemet-footer-widget-1">
					<?php kemet_get_footer_widget( 'main-footer-widget-1' ); ?>
				</div>
				<div class="kmt-col-lg-6 kmt-col-md-6 kmt-col-sm-12 kmt-col-xs-12 kemet-footer-widget kemet-footer-widget-2">
					<?php kemet_get_footer_widget( 'main-footer-widget-2' ); ?>
				</div>
			</div><!-- .kmt-row -->
		</div><!-- .kmt-container -->
	</div><!-- .kemet-footer-overlay-->
</div><!-- .kmt-theme-footer .kemet-footer-layout-2 -->
