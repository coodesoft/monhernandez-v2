<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kemet
 *
 */


get_header(); ?>

<?php if ( kemet_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php kemet_content_class(); ?>>

		<?php kemet_404_content_template(); ?>		

	</div><!-- #primary -->

<?php if ( kemet_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
