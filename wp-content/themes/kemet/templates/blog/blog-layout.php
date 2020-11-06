<?php
/**
 * Template for Blog
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

$blog_post_order = kemet_get_option( 'blog-post-structure' );

?>
<div <?php kemet_blog_layout_class( 'blog-post-layout-1' ); ?>>

	<div class="post-content kmt-col-md-12">
	<?php foreach($blog_post_order as $item){ ?>
		<?php 
		switch($item){
			case 'image':
				kemet_get_post_thumbnail( '<div class="kmt-blog-featured-section post-thumb kmt-col-md-12">', '</div>' );
				
				break;
		?>

		<?php 
		case 'title-meta':
			do_action( 'kemet_archive_entry_header_before' ); ?> 
			<header class="entry-header">
				<?php

					do_action( 'kemet_archive_post_title_before' );
					
					/* translators: 1: Current post link, 2: Current post id */
					kemet_the_title( sprintf( '<h2 class="entry-title" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>', get_the_id() );

					do_action( 'kemet_archive_post_title_after' );

				?>
				<?php

					do_action( 'kemet_archive_post_meta_before' );

					kemet_blog_get_post_meta();

					do_action( 'kemet_archive_post_meta_after' );

				?>
			</header><!-- .entry-header -->
		<?php 
				break;
		?>
		<?php 
		case 'content-readmore':
			do_action( 'kemet_archive_entry_header_after' ); ?>
				<div class="entry-content clear" itemprop="text">

				<?php kemet_entry_content_before(); ?>

				<?php kemet_the_excerpt(); ?>

				<?php kemet_entry_content_after(); ?>

				<?php
					wp_link_pages(
						array(
							'before'      => '<div class="page-links">' . esc_html( kemet_theme_strings( 'string-blog-page-links-before', false ) ),
							'after'       => '</div>',
							'link_before' => '<span class="page-link">',
							'link_after'  => '</span>',
						)
					);
				?>
			</div><!-- .entry-content .clear -->
		<?php 
				break;
			} ?>
		<?php } ?>
	</div><!-- .post-content -->

</div> <!-- .blog-layout-1 -->
