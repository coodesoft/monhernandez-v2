<?php
/**
 * Template for Small Footer Layout 2
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

$section_1 = kemet_get_copyright_footer( 'footer-copyright-section-1' );
$section_2 = kemet_get_copyright_footer( 'footer-copyright-section-2' );
$sections  = 0;

if ( '' != $section_1 ) {
	$sections++;
}

if ( '' != $section_2 ) {
	$sections++;
}

switch ( $sections ) {

	case '2':
			$section_class = 'kmt-footer-copyright-section-equally kmt-col-md-6 kmt-col-xs-12';
		break;

	case '1':
	default:
			$section_class = 'kmt-footer-copyright-section-equally kmt-col-xs-12';
		break;
}

?>

<div class="kmt-footer-copyright copyright-footer-layout-2">
	<div class="kmt-footer-copyright-content">
		<div class="kmt-container">
			<div class="kmt-footer-copyright-wrap" >
					<div class="kmt-row kmt-flex">

					<?php if ( $section_1 ) : ?>
						<div class="kmt-footer-copyright-section kmt-footer-copyright-section-1 <?php echo esc_attr( $section_class ); ?>" >
							<?php echo $section_1; ?>
						</div>
				<?php endif; ?>

					<?php if ( $section_2 ) : ?>
						<div class="kmt-footer-copyright-section kmt-footer-copyright-section-2 <?php echo esc_attr( $section_class ); ?>" >
							<?php echo $section_2; ?>
						</div>
				<?php endif; ?>

					</div> <!-- .kmt-row.kmt-flex -->
			</div><!-- .kmt-footer-copyright-wrap -->
		</div><!-- .kmt-container -->
	</div><!-- .kmt-footer-copyright-content -->
</div><!-- .kmt-footer-copyright-->
