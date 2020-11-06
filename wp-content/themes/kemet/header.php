<?php
/**
 * The header for Kemet Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kemet
 * 
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php kemet_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php kemet_schema_body(); ?> <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( kemet_theme_strings( 'string-header-skip-link', false ) ); ?></a>
    
    <?php kemet_before_header_block(); ?>

	<?php kemet_header(); ?>
    
    <?php kemet_after_header_block(); ?>

	<div id="content" class="site-content">

		<div class="kmt-container">
