<?php

/**
 * Page Title
 *
 * @package Kemet Addon
 */

$title                 = kemet_get_the_title();
$page_title_layout = apply_filters( 'kemet_the_page_title_layout' , kemet_get_option( 'page-title-layouts' ));
if(is_singular( 'post' )){
	$header_title = kemet_get_option('page-header-title');
	if($header_title == 'blog'){
		$title  = esc_html__( 'Blog', 'kemet-addons' );
	}
}
$description           = get_the_archive_description();
$classes []= $page_title_layout;
$classes_responsive = kemet_get_option( 'page-title-responsive' );
if ( $page_title_layout != 'disable' && apply_filters('kemet_disable_breadcrumbs' , true ) ) {
	$classes [] = 'has-breadcrumb';
} 
$sub_title = '';
$sub_title = apply_filters( 'kemet_sub_title_addon', $sub_title );
$classes   = implode( ' ', $classes );

?>
<div class="kmt-page-title-addon-content <?php echo esc_attr( $classes_responsive); ?>">
	<div class="kmt-page-title <?php echo esc_attr( $classes); ?>" >
		<div class="kmt-container">
			<div class="kmt-page-title-wrap">
				<?php if ( $title ) { ?>

				<h1 class="kemet-page-title"><?php echo apply_filters( 'kemet_page_title_addon_title', wp_kses_post( $title ) ); ?></h1>
					<?php if ( $sub_title ) { ?>
					<h5 class="kemet-page-sub-title"><?php echo $sub_title; ?></h5>
					<?php } ?>
				<?php } ?>
				<?php if ( $description ) { ?>
				<div class="taxonomy-description">
					<?php echo apply_filters( 'kemet_page_title_addon_description', wp_kses_post( $description ) ); ?>
				</div>
				<?php } ?>
			</div>
	<?php if ( $page_title_layout != 'disable' && apply_filters('kemet_disable_breadcrumbs' , true ) ) { ?>
			<?php kemet_breadcrumb_trail() ?>
	<?php } ?>
		</div>
	</div>
</div>
