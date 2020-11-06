<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kemet
 * 
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	
	<?php // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="comments-count-wrapper">
			<h3 class="comments-title">
				<?php
				 sprintf( 
						/* translators: 1: number of comments */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'kemet' ) ),
						number_format_i18n( get_comments_number() ), get_the_title()
				);

				?>
			</h3>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Comments Navigation', 'kemet' ); ?>">
			<h3 class="screen-reader-text"><?php echo esc_html( kemet_theme_strings( 'string-comment-navigation-next', false ) ); ?></h3>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( kemet_theme_strings( 'string-comment-navigation-previous', false ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( kemet_theme_strings( 'string-comment-navigation-next', false ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; ?>

		<ol class="kmt-comment-list">
			<?php
			wp_list_comments(
				array(
					'callback' => 'kemet_comment',
					'style'    => 'ol',
				)
			);
			?>
		</ol><!-- .kmt-comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Comments Navigation', 'kemet' ); ?>">
			<h3 class="screen-reader-text"><?php echo esc_html( kemet_theme_strings( 'string-comment-navigation-next', false ) ); ?></h3>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( kemet_theme_strings( 'string-comment-navigation-previous', false ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( kemet_theme_strings( 'string-comment-navigation-next', false ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo esc_html( kemet_theme_strings( 'string-comment-closed', false ) ); ?></p>
	<?php endif; // Check for have_comments(). ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
