<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kemet
 * @since 1.0.0
 */

?>

<?php kemet_entry_before(); ?>

<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php kemet_entry_top(); ?>

	<?php kemet_entry_content_single(); ?>

	<?php kemet_entry_bottom(); ?>

</article><!-- #post-## -->

<?php kemet_entry_after(); ?>
