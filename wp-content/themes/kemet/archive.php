<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kemet
 *
 */

get_header(); ?>

<?php if ( kemet_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php kemet_content_class(); ?>>

		<?php kemet_archive_top_info(); ?>

		<?php kemet_content_loop(); ?>

		<?php kemet_pagination(); ?>

	</div><!-- #primary -->

<?php if ( kemet_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
